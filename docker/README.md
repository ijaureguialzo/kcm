# Docker

Configuración de contenedores para arrancar la aplicación.

## Prerrequisitos

1. Instalar [Docker Desktop](https://www.docker.com/products/docker-desktop/).
2. En Windows, instalar [Scoop](https://scoop.sh) usando PowerShell:

    ```powershell
    Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
    Invoke-RestMethod -Uri https://get.scoop.sh | Invoke-Expression
    ```

   Y después instalar los comandos necesarios:

    ```powershell
    scoop install make
    ```

## Puesta en marcha

1. Arrancar los contenedores Docker:

    ```shell
    cd docker
    ```

    ```shell
    make start-dev
    ```

2. Continuar con [las instrucciones para Laravel](../laravel/README.md).
