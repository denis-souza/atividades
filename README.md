# Lista de atividades

Dump do banco na pasta /src/dump.sql

```mysql
mysql -u [USERNAME] -p[PASSWORD] [DATABASE-NAME] < dump.sql
```

Arquivo de configuração do Banco: /application/config/config.php

Acesso a lista de atividades: site.com.br/home/activities/list

@TODO - Implementar:
* Documentação do métodos.
* Adicionar ajax ao salvar uma atividade.
* Verificar erro ao salvar atividade como inativa.
* Criar o modelo relacional das tabelas.
* Ajustar o formato da data ao edita uma atividade.
* Implementar o update de uma atividade.
* Bloquear o update de uma atividade com o status concluído.
* Melhorar as mensagens de erro.
* Adicionar filtros na lista de atividades.

