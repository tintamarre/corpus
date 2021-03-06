🚧 Under construction. Please come back 🤓. 🚧 

# Corpus
## Application for Corpus analysis

Project developed by the [LegalTechLab](https://legaltech.uliege.be/) of [University of Liège](https://uliege.be) in Belgium.

![LegalTechLab](https://corpus.lltl.be/storage/legaltech_logo.png)

## Description

In order to simplify and facilitate a methodology for corpus analysis (case law, interview, focus groups, press articles, etc.), Corpus offers a service that is both simple and efficient, based on the experience in qualitative methodology by ULiège.

Available for [ULiège](https://uliege.be) students and staff at this address: <https://corpus.lltl.be/>

## Demo
<http://corpus.tintamarre.be/> with **demo@corpus.dom** / **demo**


## Docs
Documentation is available (work in progress) at <http://docs.lltl.be>

## License
GPLv3 : <https://raw.githubusercontent.com/tintamarre/corpus/main/LICENSE>

# Development

## Testing

```bash
docker-compose exec php vendor/bin/phpunit
```

### Launch
```bash
git clone https://github.com/tintamarre/corpus
cd ./corpus/src
cp .env.example .env
edit .env
docker-compose up
```

### Refresh translations
```bash
docker-compose exec php php artisan cache:clear
```

## Deploying

## Contributing
See the [contributing guidelines](https://github.com/tintamarre/corpus/blob/main/CONTRIBUTING.md).

# Production

If you want to launch your own instance of Corpus.

```bash
git clone https://github.com/tintamarre/corpus
cd ./corpus/src
cp .env.example .env
edit .env
docker-compose up
```