# Http

O Hypertext Transfer Protocol (HTTP), em português Protocolo de Transferência de Hipertexto, é um protocolo de comunicação (na camada de aplicação segundo o Modelo OSI) utilizado para sistemas de informação de hipermídia, distribuídos e colaborativos. Ele é a base para a comunicação de dados da World Wide Web.
[Fonte](https://pt.wikipedia.org/wiki/Hypertext_Transfer_Protocol)

Para facilitar o controle deste protocolo foi desenvolvido alguns classes e funções.

## Input

Possui 2 funções para captura de formulários recebidos através de uma rota.

####São eles:

- `Input::file('arquivo')`: É utilizado para captura de arquivos recebidos por uma rota.
- `Input::file('valor')`: É utilizado para captura de valores recebidos por uma rota.

####Como importar:
```
use Milhas\Http\Input\Input;
```

## Redirect

Possui 1 função para redirecionamento de páginas:

- `Redirect::to('/')`: Redireciona para a rota desejada.

####Como importar:

```
use Milhas\Http\Redirect\Redirect;
```

## Request

Possui 1 função para capturar dados recebidos por uma request JSON:

- `$request = new Request(); $request->all();`: Captura todos os dados em JSON recebidos por uma rota.
 
####Como importar:

```
use Milhas\Http\Request\Request;
```

## Route

Carrega e monitora todas as rotas adicionadas no arquivo Routes.php dentro da pasta `App` da aplicação.

#### Composição

Para criar uma rota você deve obedecer a seguinte composição:

```
['method' => 'get', 'route' => '/', 'use' => 'GalleryController@index'],
```
- `method`: Metodo suportado pela rota.
- `route`: Rota desejada.
- `use`: Caminho para o controller desta rota.

#### Metodos suportados

- GET
- POST
- PUT
- DELETE

## Flash

Classe desenvolvida para a exibição de mensagens flash.


####Como importar:

```
use Milhas\Http\Session\Flash\Flash;
```



