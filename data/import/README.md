# Demo Data

Populate your shop system with data such as product information, customers, categories, etc.

## Folder structure  
    .
    ├── ...
    ├── data/                   
    │   ├── import/
    │       ├── common/
    │           |── common/          # contains store-agnostic data for all environments, e.g currencies, customers, translations, etc.
    │           |── DE/              # contains store-specific data, e.g cms_pages, cms_blocks, etc.
    │           |── AT/
    |           └── ... 
    │       |── local/               # contains data for specific environment.
    │       |── ...
    └── ...    
