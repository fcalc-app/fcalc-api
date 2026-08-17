# fcalc-api

Нужен PHP 7.4+, больше ничего.

```
/index.php
/pages/
    calc1.html
    calc2.html
```

1. Залить `index.php` в корень сайта.
2. Рядом создать папку `pages/` и складывать туда HTML файлы.
3. В каждом HTML прописать метатеги:

```html
<meta name="app-title" content="Название">
<meta name="app-description" content="Короткое описание">
<meta name="app-image" content="data:image/png;base64...">
```

`https://домен/index.php` должен вернуть JSON со списком `id` / `hash` / `url`.