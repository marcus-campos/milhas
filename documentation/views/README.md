# View

A visão (view) Gera uma representação (Visão) dos dados presentes no modelo solicitado.

[Fonte](https://pt.wikipedia.org/wiki/MVC)

## View

O Milhas framework não conta com template para a renderização de views, mas disponibiliza uma variável para a caputura de dados passados pelo render.

Você pode utiliza-la como no exemplo abaixo:

```
<html>
    <head>
    </head>
    <body>
        <?= $this->view->minhaVariavel ?>
    </body>
</html>
```