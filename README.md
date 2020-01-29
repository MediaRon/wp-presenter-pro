# WP Presenter Pro

[![Build Status](https://travis-ci.org/ronalfy/wp-presenter-pro.svg?branch=master)](https://travis-ci.org/ronalfy/wp-presenter-pro)

## Documentation

<a href="https://wppresenter.pro">View the Documentation</a>

## Gutenberg Devs

1. Clone the repository
2. Run ```npm install```
3. Edit the block in ```src/blocks```
4. To develop run: ```npm run start```
5. To build for deployment run: ```npm run build && wp i18n make-pot . languages/wp-presenter-pro.pot --exclude="/src/js,src/block"```