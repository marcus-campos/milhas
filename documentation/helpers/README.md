# Helpers

Funções auxiliares acessíveis em qualquer parte do software.

## Funções

- `appMake('caminho_da_classe')`: Monta uma classe a partir do caminho informado.
- `dd($value)`:              Dump de valores. É utilizado para debugar a aplicação em tempo de execução.
- `rootPath('path_to')`:     Retorna o caminho para o diretório `root` e adiciona o caminho passado para a função.
- `appPath('path_to')`:      Retorna o caminho para o diretório `App` e adiciona o caminho passado para a função.
- `configPath('path_to')`:   Retorna o caminho para o diretório `config` e adiciona o caminho passado para a função.
- `publicPath('path_to')`:   Retorna o caminho para o diretório `public` e adiciona o caminho passado para a função.
- `storagePath('path_to')`:  Retorna o caminho para o diretório `storage` e adiciona o caminho passado para a função.
- `databasePath('path_to')`: Retorna o caminho para o diretório `database` e adiciona o caminho passado para a função.
- `deleteFile('path_to')`:   Deleta o arquivo no caminho informado.
