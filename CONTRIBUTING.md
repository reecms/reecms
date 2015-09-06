
# Coding standards

## Overview

This repository follow these standards

* [PSR-1](http://www.php-fig.org/psr/psr-1/)
* [PSR-2](http://www.php-fig.org/psr/psr-2)

## Additional naming convention

* PHP functions always use `under_score` to separate words.
* Private PHP members and methods begin with the underscore (`_`) in their name.

### File name (and folder name)

The file extension is always in lower case.

#### PHP files

PHP files use only `StudlyCaps` or `under_score` in file name. 

* Files defining classes, interfaces, traits (except *migration* files) use `StudlyCaps` and need to match with the name of the class/interface/trait they define.
* Other types of file use `under_score`
* Folders use `StudlyCaps` if they need to be autoloading. Otherwise, use `under_score`.

#### Asset files

Asset files (stylesheets, scripts, images, ...) use `hyphen-name` in their files name. The underscore `_` is used only at the beginning of the file name in some cases.

### HTML

* all HTML tags are written in lower case except the first `DOCTYPE`
* attribute names and values use hyphens (`-`), **not** underscore (`_`) to separate words, except:
	* the value of the `name` attribute uses underscore
	* the value of the `id` attribute **of form control elements** (`input`, `select`) uses underscore.

### JavaScript

* Use `StudlyCaps` for "classes"
* Use `camelCase` for functions, variables, methods
* Use `ALL_CAPS` for constants
* Use `under_score` for object properties
* The dollar sign (`$`) can be use at the beginning of variables containing jQuery objects.

