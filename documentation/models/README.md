# Models

Um modelo (model) armazena dados e notifica suas visões e controladores associados quando há uma mudança em seu estado. Estas notificações permitem que as visões produzam saídas atualizadas e que os controladores alterem o conjunto de comandos disponíveis. Uma implementação passiva do MVC monta estas notificações, devido a aplicação não necessitar delas ou a plataforma de software não suportá-las.

[Fonte](https://pt.wikipedia.org/wiki/MVC)

## BaseModel

O Milhas framework conta com uma clase extendível que herda funções para a manipulação de sua base de dados.

Para fazer o uso destas funções, basta extender seu model como no exemplo abaixo:

```
<?php

namespace App\Models;


use Milhas\Model\BaseModel;

class Gallery extends BaseModel
{
    protected $table = 'gallery';

    protected $fillable = [
        'name',
        'path',
        'created_at'
    ];
}
```

#Funções herdadas

Após extender sua classe você irá herdar funções e variáveis para facilitar a manipulação de sua base de dados a partir de seu model.


##Varáveis de configuração

- `protected $table = 'gallery';`: Informa ao BaseModel qual a tabela que seu model se refere.
- `protected $fillable = [
           'name',
           'path',
           'created_at'
];`: Informa ao BaseModel qual são os campos que necessitam de valores a serem inseridos antes de enviar para a base de dados.

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

##Funções

- `$this->all()`: Retorna todos os valores armazenados na tabela.
- `$this->find($id)`: Busca e retorna o valor correspondente ao `$id` passado para a função.
- `$this->delete($id)`: Apaga o valor o valor correspondente ao `$id` passado para a função.
- `$this->query($query, ['a'=>'b', 'c'=>'d'])`: Função para executar instruções manuais escritas em SQL. 
- `$this->save(['a'=>'b', 'c' => 'd'])`: Salva os respectivos valores e colunas na tabela.