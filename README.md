[![Build Status](https://travis-ci.org/jontepson/mvc.svg?branch=master)](https://travis-ci.org/jontepson/mvc)

# MVC Project

This MVC project is a place where you can play a simple game to 21 or a yatzy game.

## Installation

You can download this project from (https://github.com/jontepson/mvc/tree/v7.2.2)
or from (https://github.com/jontepson/mvc/tree/master)

git required

Local server ex. XAMPP

```bash
$ git clone -b master https://github.com/jontepson/mvc

$ cd mvc

$ make install
```


Run the project on a local server by starting the public folder.

## Debug

Case missmatch error

Go to line 380 and line 406 in /vendor/symfony/errorhandler/DebugClassLoader.php
replace it with 


if ($name === $class) {
    if ($name !== $class && 0 === strcasecmp($name, $class)) {
        throw new \RuntimeException(sprintf('Case mismatch between loaded and declared class names: %s vs %s', $class, $name));
    } 
}

Clear cache
```bash
$ php bin/console cache:clear

```
Good to go

## How To play

Check doc/instruction/:game


## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

