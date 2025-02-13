# Welcome to nano-erp-laravel 👋
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

> Cadastro de clientes, fornecedores, funcionários e empresas, entradas e saídas de mercadorias e pdv de vendas

![nano-erp](https://github.com/luiz-moura/nano-erp-laravel/assets/57726726/5b4ca63a-a730-4fc5-84cc-c10decd11fe2)

## Technologies
- [Laravel](https://laravel.com)
- [Bootstrap](https://getbootstrap.com/)
- [DOMPDF](https://github.com/barryvdh/laravel-dompdf)
- [PurgeCSS](https://github.com/spatie/laravel-mix-purgecss)
- [Chart.js](https://www.chartjs.org)

## Install

1. Clone the project
```bash
  git clone https://github.com/luiz-moura/nano-erp-laravel.git
```

2. Create .env
```bash
  cp .env.example .env
```

3. Start the server in background
```bash
  docker-compose up -d
```

4. Create aliases for sail bash path
```bash
  alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

5. Generate key
```bash
  sail artisan key:generate
```

6. Install composer dependencies
```bash
  sail composer install
```

7. Run migrations
```bash
  sail artisan migrate --seed
```

8. Install NPM dependencies
```bash
  sail npm install && sail npm run dev
```

Project listen in port http://localhost:80

## Author

👤 **Luiz Moura**

* Github: [@luiz-moura](https://github.com/luiz-moura)
* LinkedIn: [@luiz-moura](https://linkedin.com/in/luiz-moura)

## Show your support

Give a ⭐️ if this project helped you!


## 📝 License

Copyright © 2022 [Luiz Moura](https://github.com/luiz-moura).

This project is [MIT License](https://opensource.org/licenses/MIT) licensed.

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_
