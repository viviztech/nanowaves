# Tailwind CSS v4 & Vite Configuration Guide

This project is configured with **Tailwind CSS v4** and **Vite** for optimal development and production builds.

## Configuration Files

### 1. `vite.config.js`
- Configured with Laravel Vite plugin
- Tailwind CSS v4 plugin integrated
- HMR (Hot Module Replacement) enabled for development
- Optimized build configuration

### 2. `resources/css/app.css`
- Tailwind CSS v4 imported
- Custom theme variables defined
- Source paths configured for Blade templates
- Custom utility classes added

### 3. `package.json`
- Dependencies:
  - `tailwindcss@^4.0.0` - Tailwind CSS v4
  - `@tailwindcss/vite@^4.0.0` - Vite plugin for Tailwind
  - `vite@^7.0.7` - Vite build tool
  - `laravel-vite-plugin@^2.0.0` - Laravel integration

## Getting Started

### 1. Install Dependencies
```bash
npm install
```

### 2. Development Mode
Run Vite dev server with hot reload:
```bash
npm run dev
```

Then start Laravel server in another terminal:
```bash
php artisan serve
```

### 3. Production Build
Build assets for production:
```bash
npm run build
```

## How It Works

### Tailwind CSS v4 Features
- **CSS-based configuration**: Theme variables defined in `app.css` using `@theme`
- **Vite integration**: Uses `@tailwindcss/vite` plugin for fast builds
- **Source scanning**: Automatically scans Blade templates and JS files
- **No config file needed**: Configuration is done in CSS using `@theme` directive

### Vite Features
- **Hot Module Replacement**: Changes reflect instantly in browser
- **Fast builds**: Optimized for development and production
- **Asset optimization**: Automatic code splitting and minification
- **Laravel integration**: Seamless integration with Laravel's asset pipeline

## Custom Theme Variables

The following custom variables are defined in `app.css`:

```css
--color-primary: #2563eb
--color-primary-dark: #1e40af
--color-primary-light: #3b82f6
```

## Usage in Blade Templates

Use the `@vite` directive in your Blade templates:

```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

## Troubleshooting

### Assets not loading?
1. Make sure Vite dev server is running: `npm run dev`
2. Check that `@vite` directive is in your Blade template
3. Clear Laravel cache: `php artisan cache:clear`

### Styles not applying?
1. Ensure Tailwind classes are being used correctly
2. Check browser console for errors
3. Verify `@source` paths in `app.css` include your Blade files

### Build errors?
1. Delete `node_modules` and `package-lock.json`
2. Run `npm install` again
3. Clear Vite cache: Delete `.vite` directory if exists

## Additional Resources

- [Tailwind CSS v4 Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/)
- [Laravel Vite Plugin](https://laravel.com/docs/vite)

