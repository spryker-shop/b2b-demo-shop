#!/bin/bash

# Parse arguments
for arg in "$@"
do
    case $arg in
        --deploy-file=*)
        DEPLOY_FILE="${arg#*=}"
        shift
        ;;
        --demo-shop-type=*)
        DEMO_SHOP_TYPE="${arg#*=}"
        shift
        ;;
        --npm-command=*)
        NPM_COMMAND="${arg#*=}"
        shift
        ;;
        --github-workflow-runner-bearer-token=*)
        GITHUB_WORKFLOW_RUNNER_BEARER_TOKEN="${arg#*=}"
        shift
        ;;
        --github-workflow-runner-org-name=*)
        GITHUB_WORKFLOW_RUNNER_ORG_NAME="${arg#*=}"
        shift
        ;;
        --github-workflow-runner-repository=*)
        GITHUB_WORKFLOW_RUNNER_REPOSITORY="${arg#*=}"
        shift
        ;;
    esac
done

if [ -z "$DEPLOY_FILE" ]; then
    echo "Error: --deploy-file is not specified"
    exit 1
fi

if [ -z "$DEMO_SHOP_TYPE" ]; then
    echo "Error: --demo-shop-type is not specified"
    exit 1
fi

if [ -z "$NPM_COMMAND" ]; then
    echo "Error: --npm-command is not specified"
    exit 1
fi

if [ -z "$GITHUB_WORKFLOW_RUNNER_BEARER_TOKEN" ]; then
    echo "Error: --github-workflow-runner-bearer-token is not specified"
    exit 1
fi

if [ -z "$GITHUB_WORKFLOW_RUNNER_ORG_NAME" ]; then
    echo "Error: --github-workflow-runner-org-name is not specified"
    exit 1
fi

if [ -z "$GITHUB_WORKFLOW_RUNNER_REPOSITORY" ]; then
    echo "Error: --github-workflow-runner-repository is not specified"
    exit 1
fi


extract_host() {
    local app_type="$1"
    awk -v app="$app_type" '
    $0 ~ "application: " app {found=1}
    found && $0 ~ "endpoints:" {getline; print; exit}
    ' "$DEPLOY_FILE" | awk -F: '{gsub(/[ \t]+/, "", $1); print $1}'
}

# Extract domain names based on application type
SPRYKER_BE_HOST=$(extract_host "backoffice")
SPRYKER_MP_HOST=$(extract_host "merchant-portal")
SPRYKER_API_HOST=$(extract_host "glue")
SPRYKER_GLUE_BACKEND_HOST=$(extract_host "glue-backend")
SPRYKER_GLUE_STOREFRONT_HOST=$(extract_host "glue-storefront")
SPRYKER_FE_HOST=$(extract_host "yves")
CODEBUILD_BUILD_ID=${CODEBUILD_BUILD_ID}

SPRYKER_VARS="CODEBUILD_BUILD_ID DEMO_SHOP_TYPE NPM_COMMAND SPRYKER_BE_HOST SPRYKER_MP_HOST SPRYKER_API_HOST SPRYKER_GLUE_BACKEND_HOST SPRYKER_GLUE_STOREFRONT_HOST SPRYKER_FE_HOST"

# Prepare the client payload
client_payload='{"workflow":"true"'

# Add SPRYKER_ environment variables to the client payload
for var in $SPRYKER_VARS; do
    value=${!var}
    client_payload+=',"'"$var"'":"'"$value"'"'
done

client_payload+='}'

curl -L \
  -X POST \
  -H "Accept: application/vnd.github+json" \
  -H "Authorization: Bearer ${GITHUB_WORKFLOW_RUNNER_BEARER_TOKEN}" \
  -H "X-GitHub-Api-Version: 2022-11-28" \
  https://api.github.com/repos/${GITHUB_WORKFLOW_RUNNER_ORG_NAME}/${GITHUB_WORKFLOW_RUNNER_REPOSITORY}/dispatches \
  -d '{"event_type":"post-deploy-workflow","client_payload":'"$client_payload"'}'
