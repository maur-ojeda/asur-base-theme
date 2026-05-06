# asur-base-theme

![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![WordPress](https://img.shields.io/badge/WordPress-21759B?logo=wordpress&logoColor=white)
![Status](https://img.shields.io/badge/status-active_production-green)

Professional WordPress base theme with modern patterns. Built and maintained for production use at **AgenciaSur**.

## Features

- Modern WordPress theme structure
- Clean, maintainable codebase
- Customizable template hierarchy
- Production-ready defaults
- Built for extendability

## Installation

### Standard WordPress Install

1. Download or clone this repository
2. Copy the `asur-base-theme` folder into `wp-content/themes/`
3. In the WordPress admin, navigate to **Appearance → Themes**
4. Activate **asur-base-theme**

### Via Git (recommended for developers)

```bash
cd wp-content/themes/
git clone https://github.com/maur-ojeda/asur-base-theme.git
```

Then activate from **Appearance → Themes** in the WordPress admin.

## Customization

This is a **base theme** — designed to be extended, not used directly in production as-is.

- **Child theme:** Create a child theme that inherits from `asur-base-theme` for project-specific customizations
- **Templates:** Override any template by duplicating it in your child theme
- **Functions:** Hook into filters and actions defined in `functions.php`

## Tech Stack

- **Language:** PHP
- **Platform:** WordPress
- **Structure:** Modern WordPress theme conventions

## License

This project is proprietary. All rights reserved.
