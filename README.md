# Spiral GRPC Application Skeleton [![Latest Stable Version](https://poser.pugx.org/spiral/app-grpc/version)](https://packagist.org/packages/spiral/app-grpc)

<img src="https://raw.githubusercontent.com/spiral/guide/master/resources/logo.png" height="120px" alt="Spiral Framework" align="left"/>

Spiral is an open-source (MIT) micro-framework core that uses a set of open-source components and [an application server](https://github.com/spiral/roadrunner) which is designed to rapidly develop (RAD) high-performance PHP-applications that come with native support for HTTP/2, [GRPC](https://grpc.io/), distributed computations ([Queue](https://github.com/spiral/jobs)) and Golang extensions. 

[Website](https://spiral-framework.com) | <b>[App Skeleton](https://github.com/spiral/app)</b> ([cli](https://github.com/spiral/app-cli), [grpc](https://github.com/spiral/app-grpc)) | [Documentation (v1.0.0)](https://github.com/spiral/guide) | [Twitter](https://twitter.com/spiralphp) | [CHANGELOG](/CHANGELOG.md) | [Contributing](https://github.com/spiral/guide/blob/master/contributing.md)

<br/>

Server Requirements
--------
Make sure that your server is configured with following PHP version and extensions:
* PHP 7.1+
* MbString Extension
* PDO Extension with desired database drivers

> [Install](https://github.com/protocolbuffers/protobuf/tree/master/php) `protobuf-ext` to gain higher performance. 

Application Bundle
--------
Application bundle includes following components:
* High-Performance HTTP, HTTP/2 server based on [RoadRunner](https://roadrunner.dev)
* GRPC Server
* Console commands via symfony/console
* Queue support for AMQP, Beanstalk, Amazon SQS, in-Memory
* DBAL and migrations support
* [Cycle DataMapper ORM](https://github.com/cycle)

Installation
--------
```
composer create-project spiral/app-grpc
```

> Application server will be downloaded automatically.

Once application is installed you can ensure that it was configured properly by executing:

```
$ php ./app.php configure
```

## Running GRPC Server
In order to run GRPC server you must specify location of server key and certificate in `.rr.yaml` file:

```yaml
grpc:
  listen: tcp://0.0.0.0:50051
  proto: "proto/service.proto"
  workers.command: "php app.php"
  tls.key:  "app.key"
  tls.cert: "app.crt"
```

To issue local certificate:

```
$ openssl req -newkey rsa:2048 -nodes -keyout app.key -x509 -days 365 -out app.crt
```

To start application server execute:

```
$ ./spiral serve -v -d
```

On Windows:

```
$ spiral.exe serve -v -d
```

You can test your endpoints using any GRPC client. For example using [grpcui](https://github.com/fullstorydev/grpcui):

```
$ grpcui -insecure -import-path ./proto/ -proto service.proto localhost:50051
``` 

> Make sure to use `-insecure` option while using self-signed certificate.
> Read more about application server configuration [here](https://roadrunner.dev/docs).

Generating Services
--------
To update or generate service code for your application run:

```
$ php ./app.php grpc:generate proto/service.proto
```

Generated code will be available in `app/src/Service`. Implemented service will be automatically registered in your application.

License:
--------
MIT License (MIT). Please see [`LICENSE`](./LICENSE) for more information. Maintained by [Spiral Scout](https://spiralscout.com).
