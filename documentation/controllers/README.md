# Controller

Um controlador (controller) envia comandos para o modelo para atualizar o seu estado (por exemplo, editando um documento). O controlador também pode enviar comandos para a visão associada para alterar a apresentação da visão do modelo (por exemplo, percorrendo um documento).

[Fonte](https://pt.wikipedia.org/wiki/MVC)

## Controller

O Milhas framework conta com uma clase extendível que herda funções para a renderização de páginas HTML.

Para fazer o uso destas funções, basta extender seu controller como no exemplo abaixo:

```
<?php

namespace App\Controllers;


use App\Models\Gallery;
use Milhas\Controller\Controller;
use Milhas\Http\Request\Request;

class GalleryController extends Controller
{
    
}
```

#Funções herdadas

Após extender sua classe você irá herdar algumas funções para facilitar a exibição de views a partir de seu controller.

###Render

Renderiza views geralmente escritas em HTML. Você poderá dividir sua interface em views e exibi-las como no exemplo abaixo:

```
<?php

namespace App\Controllers;


use App\Models\Gallery;
use Milhas\Controller\Controller;
use Milhas\Http\Request\Request;

class GalleryController extends Controller
{
    public function index()
    {
        return $this->render('layout', ['a' => 'b', 'c' => 'd']);
    }
}
```