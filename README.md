# devtool-plugin
esd-projects 插件，支持实体类生成

```$xslt
php start_server.php entity -h
```

```$xslt
Description:
  Entity generator

Usage:
  entity [options] [--] [<pool>]

Arguments:
  pool                       database db pool? [default: "default"]

Options:
  -t, --table[=TABLE]        database table name? (multiple values allowed)
  -p, --path[=PATH]          generate entity file path? [default: "@app/Model/Entity"]
  -a, --template[=TEMPLATE]  generate entity template path? [default: "@devtool/resources"]
  -y, --confirm              confirm execution?
  -h, --help                 Display this help message
  -q, --quiet                Do not output any message
  -V, --version              Display this application version
      --ansi                 Force ANSI output
      --no-ansi              Disable ANSI output
  -n, --no-interaction       Do not ask any interactive question
  -v|vv|vvv, --verbose       Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```
##Usage
```$xslt
php start_server.php entity -p @elite/Common/Model/Entity
```
或者指定表名
```$xslt
 php start_server.php entity -t user -t order -p @elite/Common/Model/Entity -y
```