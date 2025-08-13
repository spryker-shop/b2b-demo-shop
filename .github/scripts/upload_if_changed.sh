#!/bin/bash
set -euo pipefail

# This script reads its configuration from environment variables:
# - APP_TYPE:      e.g., "b2b"
# - API_TYPE:      "storefront" or "backoffice"
# - SOURCE_YAML:   e.g., "spryker_storefront_api.schema.yml"
# - S3_BUCKET:     e.g., "spryker"
# - S3_PREFIX:     e.g., "docs/api-specs"
# - API_UPLOAD_S3_AWS_REGION e.g., "eu-centra-1"
# - API_UPLOAD_S3_AWS_ACCESS_KEY_ID
# - API_UPLOAD_S3_AWS_SECRET_ACCESS_KEY

# Define filenames
if [ "$API_TYPE" == "backoffice" ]; then
    TARGET_JSON_FILENAME="${APP_TYPE}_backoffice_api.json"
else
    TARGET_JSON_FILENAME="${APP_TYPE}_storefront_api.json"
fi

S3_URI="s3://${S3_BUCKET}/${S3_PREFIX}/${TARGET_JSON_FILENAME}"
S3_KEY="${S3_PREFIX}/${TARGET_JSON_FILENAME}"
TEMP_JSON_FILE="temp_${TARGET_JSON_FILENAME}"

echo "--- Processing ${SOURCE_YAML} for ${APP_TYPE} ---"
echo "Target S3 URI: ${S3_URI}"

if [ ! -f "${SOURCE_YAML}" ]; then
    echo "Error: Source YAML file '${SOURCE_YAML}' not found."
    exit 1
fi

echo "Converting YAML to JSON..."
yq eval -o=json . "${SOURCE_YAML}" > "${TEMP_JSON_FILE}"
if [ ! -s "${TEMP_JSON_FILE}" ]; then
    echo "Error: Conversion to JSON failed or produced an empty file."
    exit 1
fi

LOCAL_MD5=$(md5sum "${TEMP_JSON_FILE}" | awk '{ print $1 }')
echo "Local file MD5: ${LOCAL_MD5}"

REMOTE_ETAG=$(AWS_DEFAULT_REGION=${API_UPLOAD_S3_AWS_REGION} AWS_ACCESS_KEY_ID=${API_UPLOAD_S3_AWS_ACCESS_KEY_ID} AWS_SECRET_ACCESS_KEY=${API_UPLOAD_S3_AWS_SECRET_ACCESS_KEY} aws s3api head-object --bucket "${S3_BUCKET}" --key "${S3_KEY}" --query 'ETag' --output text 2>/dev/null | tr -d '"' || echo "not_found")
echo "Remote object ETag: ${REMOTE_ETAG}"

if [ "${LOCAL_MD5}" == "${REMOTE_ETAG}" ]; then
    echo "Content is unchanged. No upload needed for ${TARGET_JSON_FILENAME}."
else
    echo "Content has changed or is new. Uploading ${TARGET_JSON_FILENAME}..."
    AWS_DEFAULT_REGION=${API_UPLOAD_S3_AWS_REGION} AWS_ACCESS_KEY_ID=${API_UPLOAD_S3_AWS_ACCESS_KEY_ID} AWS_SECRET_ACCESS_KEY=${API_UPLOAD_S3_AWS_SECRET_ACCESS_KEY} aws s3 cp "${TEMP_JSON_FILE}" "${S3_URI}"
#    aws s3 cp "${TEMP_JSON_FILE}" "${S3_URI}" --acl public-read
    echo "Upload complete."
fi
echo "-------------------------------------------"
