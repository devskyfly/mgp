## Yii2 Module Extension Template

### Settings

1. Set in composer.json properties "name"

2. Set in composer.json "autoload/psr-4" (vendor//package//)

```json
{
    "autoload" : {
		"psr-4" : {
			"" : "src"
		}
    },
}
```

3. Set db connection properties tests/app/config/components/db.php (dbname, user, password)
4. Define testsClear method, this method invokes before tests runs.

##  Init

1. Execute

```bash
composer install
```

2. Execute

```bash
robo dev:init-project 
```

3. Rm or edit src/console/CommandController.php

4. Rm or edit src/Module.php

5. Rm or edit src/ModuleException.php

6. Start development