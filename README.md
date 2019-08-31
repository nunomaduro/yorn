<p align="center">
  <img src="https://raw.githubusercontent.com/nunomaduro/yorn/master/docs/banner.png" width="400" alt="Yorn Preview">
  <p align="center">
    <a href="https://travis-ci.org/nunomaduro/yorn"><img src="https://img.shields.io/travis/nunomaduro/yorn/master.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/nunomaduro/yorn"><img src="https://poser.pugx.org/nunomaduro/yorn/d/total.svg" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/nunomaduro/yorn"><img src="https://poser.pugx.org/nunomaduro/yorn/v/stable.svg" alt="Latest Version"></a>
    <a href="https://packagist.org/packages/nunomaduro/yorn"><img src="https://poser.pugx.org/nunomaduro/yorn/license.svg" alt="License"></a>
  </p>
  <p align="center">
    <strong>Modules for PHP.
  </p>
</p>

**Yorn** was carefully crafted to simplify the autoload of modules in PHP.
It was created by **[Nuno Maduro](https://github.com/nunomaduro)**.

## 🚀 Quick start

```
# First, install:
composer require nunomaduro/yorn --dev
```

## ✨ Exporting a function

Any function can be exported by using the `export` function:
```php
# src/validators/zipCodeValidator.php:
<?php export(function (string $value)) {
    return strlen($value) === 5;
});
```

## ✨ Importing a function

Importing is just about as easy as exporting from a module. Importing an exported declaration is done through using one of the `import` forms below:
```php
# src/index.php
<?php

import('validators/zipCodeValidator');

echo zipCodeValidator(8000);
```

# ✨ Default exports

Of course, you may want to import all functions in a `module`:
```php
# src/index.php
<?php

import('validators'); // zipCodeValidator is imported also here

echo zipCodeValidator(8000);
```

## 💖 Support the development
**Do you like this project? Support it by donating**

- PayPal: [Donate](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=66BYDWAT92N6L)
- Patreon: [Donate](https://www.patreon.com/nunomaduro)

Yorn is open-sourced software licensed under the [MIT license](LICENSE.md).
