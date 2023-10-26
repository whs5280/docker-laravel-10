# Composer的自动加载

### 原理
在 `composer.json` 文件配置需要加载的类、命令空间、文件，执行`composer install` 命令生成类名和文件路径的映射关系，
再通过 `$loader->register(true)` 注册`loadClass` 方法，实现对类的自动加载。

### composer.json文件
```PHP
{
    "autoload": {
        "psr-4": {
            "DfaFilter\\": "src/DfaFilter"
        },
        "files": [
            "src/helpers.php"
        ]
    }
}
```

关键词`autolad` 是composer支持的四种配置 
- psr-0(已废弃)
- psr-4(对应生成`autoload_psr4.php` 文件)
- classmap(对应生成`autoload_classmap.php` 文件)
- files(对应生成`autoload_files.php` 文件)

### 代码逻辑
- 首次加载，将`composer.json` 不同配置项生成到不同的配置文件，以数组的形式存在，`key` 类名 => `value` 文件路径
- 之后的加载，读取`autoload_static.php` 文件
- `$loader->register(true)` 具体实现了类的加载逻辑

### 核心代码
```PHP
public function register($prepend = false)
{
    # 调用未定义的类, 会触发魔术函数`__autoload`, 5.1版本已废弃，被`spl_autoload_register`取代
    spl_autoload_register(array($this, 'loadClass'), true, $prepend);

    if (null === $this->vendorDir) {
        return;
    }

    if ($prepend) {
        # 使用 + 运算符来合并两个数组时，会保留两个数组中都存在的键（即不覆盖），并将只存在于第一个数组中的键和值添加到结果数组中。如果两个数组中有相同的键，则第一个数组中的值会覆盖第二个数组中的值
        self::$registeredLoaders = array($this->vendorDir => $this) + self::$registeredLoaders;
    } else {
        unset(self::$registeredLoaders[$this->vendorDir]);
        self::$registeredLoaders[$this->vendorDir] = $this;
    }
}

# 加载类
public function loadClass($class)
{
    # 调用函数, 会把class文件的 `use`全部加载, 通过类名找到路径
    if ($file = $this->findFile($class)) {
        includeFile($file);

        return true;
    }

    return null;
}

# 加载依赖
function includeFile($file)
{
    # 使用`include` 引入依赖
    include $file;
}
```

### 加载方式
入口文件引入 `require dirname(__DIR__) . '/vendor/autoload.php';`
