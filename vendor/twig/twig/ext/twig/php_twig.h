/*
   +----------------------------------------------------------------------+
   | Twig Extension                                                       |
   +----------------------------------------------------------------------+
   | Copyright (c) 2011 Derick Rethans                                    |
   +----------------------------------------------------------------------+
   | Redistribution and use in source and binary forms, with or without   |
   | modification, are permitted provided that the conditions mentioned   |
   | in the accompanying LICENSE file are met (BSD-3-Clause).             |
   +----------------------------------------------------------------------+
   | Author: Derick Rethans <derick@derickrethans.nl>                     |
   +----------------------------------------------------------------------+
 */

#ifndef PHP_TWIG_H
#define PHP_TWIG_H

<<<<<<< HEAD
#define PHP_TWIG_VERSION "1.32.0"
=======
#define PHP_TWIG_VERSION "1.35.4-DEV"
>>>>>>> 206e700976eb3b082c0b018e598c85cc801f80eb

#include "php.h"

extern zend_module_entry twig_module_entry;
#define phpext_twig_ptr &twig_module_entry
#ifndef PHP_WIN32
zend_module_entry *get_module(void);
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_FUNCTION(twig_template_get_attributes);
PHP_RSHUTDOWN_FUNCTION(twig);

#endif
