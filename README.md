# messangers_microservice
```bash
$ git clone https://github.com/asmarkov/messangers_microservice.git
$ cd messangers_microservice
$ composer install
$ ./vendor/bin/homestead make
$ vagrant up
$ vagrant ssh
$ cd ~/code/
$ sudo ./after.sh
```

После этих действий проект будет полностью готов к работе. Будет сделана миграция и создан демон для обработки заданий очереди.

Был выбран Lumen-Framework, так как это легкий и производительный фреймворк для микросервиса и имеет нужный функционал для раелизации задания.

Пример запроса

```bash
$ curl --header "Content-Type: application/json"   --request POST   --data '[{"user_id":1,"messenger":"viber","message":"asdas asd as\r\nasdasd\r\nadasd","wakeup":"2019-03-01 23:45:50"},{"user_id":5,"messenger":"viber","message":"asdas asd as\r\nasdasd\r\nasasd"}]'   http://localhost:8000/
```