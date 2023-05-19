# MyMed - Proyecto Final Redes e Infraestructura

MyMed es una aplicación de gestión de medicamentos, construida en una arquitectura basada en microservicios utilizando NodeJs, empaquetada en Docker. 

## Autores de MyMed

- [Emmanuel Quintero Palma](https://github.com/emmanuelqp)
- [Juan Camilo Buitrago](https://github.com/jcamilobg)
- [Juan Camilo Burbano](https://www.github.com/SamuelEscalante)
- [María de los Angeles Amú](https://github.com/mdlangeles)
- [Manuela Mayorga Rojas](https://github.com/ManuelaMayorga1)
- [Samuel Escalante](https://www.github.com/SamuelEscalante)

## Herramientas Utilizadas

**Vagrant:** 2.3.4

**Docker Community Edition:** 23.0.1

**Docker Compose:**  v2.16.0

**Vagrant Box Ubuntu** 

## Vagrant File

Usando un Box de Ubuntu, el vagrant file es el siguiente: 

```bash
# -*- mode: ruby -*-
# vi: set ft=ruby :
Vagrant.configure("2") do |config|

  if Vagrant.has_plugin? "vagrant-vbguest"
  config.vbguest.no_install = true
  config.vbguest.auto_update = false
  config.vbguest.no_remote = true
  end

  config.vm.define :clienteUbuntu do |clienteUbuntu|
    clienteUbuntu.vm.box = "bento/ubuntu-22.04"
    clienteUbuntu.vm.network :private_network, ip: "192.168.100.3"
    clienteUbuntu.vm.hostname = "clienteUbuntu"
    clienteUbuntu.vm.box_download_insecure=true
  end

  config.vm.define :servidorUbuntu do |servidorUbuntu|
    servidorUbuntu.vm.box = "bento/ubuntu-22.04"
    servidorUbuntu.vm.network :private_network, ip: "192.168.100.2"
    servidorUbuntu.vm.hostname = "servidorUbuntu"
    servidorUbuntu.vm.box_download_insecure=true
  end
end
```
## Instalar y dejar funcionando docker en la maquina virtual

Desde una terminal de Ubuntu instalamos docker para poder posteriormente agregar la extension de docker compose

Compruebe que no tenga versiones de docker instaladas anteriormente

```bash
  sudo apt-get remove docker docker-engine docker.io containerd runc
```
Actualizar el paquete apt e instale paquetes para permitir que apt use
un repositorio a traves de HTTPS

```bash
  sudo apt-get update
  sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common
```
 Agregue la clave GPG* oficial de Docker

```bash
  curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add
```
Verifique	que	tiene	la	clave	con	el	fingerprint 9DC8	5822	9FC7	DD38	854A E2D8	
8D81	803C	0EBF	CD88,	buscando	los	ultimos 8	caracteres	del	fingerprint

```bash
  sudo apt-key fingerprint 0EBFCD88
```
Agregar un repositorio stable

```bash
  sudo add-apt-repository \
    "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
    $(lsb_release -cs) \
    stable"
```
Actualice el paquete apt e instale la ultima version de Docker
Engine.

```bash
  sudo apt-get update

  sudo apt-get install docker-ce docker-ce-cli containerd.io
```
Verificar que Docker este corriendo

```bash
 sudo systemctl status docker
```

## Instalar el plugin de docker compose

Instalacion de Docker Compose en Ubuntu

```bash
 sudo apt-get update
 
 sudo apt-get install docker-compose-plugin
```
Verificar la version de docker compose instalada

```bash
docker compose version
```
Modificar (Crear) el archivo ~/.vimrc para trabajar con Yaml.

```bash
vim ~/.vimrc
```
Agregar la siguiente configuracion, con el fin de trabajar
adecuadamente con tabs y espacios en los archivos yaml.

```bash
  " Configuracion para trabajar con archivos yaml
au! BufNewFile,BufReadPost *.{yaml,yml} set filetype=yaml foldmethod=indent
autocmd FileType yaml setlocal ts=2 sts=2 sw=2 expandtab
```
Una vez configurado vim se puede crear el archivo .yml.

## Correr MyMed localmente

MyMed esta pensado para correr en maquinas virtuales con Ubuntu como sistema operativo basado en linux ejecutandose en la direccion IP 192.168.100.2

Clone el repositorio de este proyecto

```bash
  git clone https://github.com/SamuelEscalante/ProyectoRedes_MyMed.git
```

Muevete al directorio del proyecto

```bash
  cd ProyectoRedes_MyMed
```

Trae las imagenes pertinentes del repositorio de DockerHub (ejecuta los comandos linea por linea)

```bash
  sudo docker pull saalesgu/haproxy
  sudo docker pull saalesgu/microusuarios
  sudo docker pull saalesgu/micromedic
  sudo docker pull saalesgu/microcompras
  sudo docker pull saalesgu/microweb
```

Inicia el docker compose

```bash
  sudo docker compose up -d
```

Verifica el correcto funcionamiento de los contenedores

```bash
  sudo docker ps
```
Comprueba su funcionamiento en el navegador con la direccion ip y recuerda que se esta ejecutando por el puerto 4090

```bash
  192.168.100.2:4090
```

## Escalar MyMed con Docker Swarm

Cree un cluster de docker swarm con un nodo corriendo en el servidor

```bash
  sudo docker swarm init --advertise-addr 192.168.100.2
```

Asegurese que la versión del docker-compose.yml sea
```bash
    version: "3"
```

Ejecute

```bash
  sudo docker stack deploy -c docker-compose.yml mymed
  sudo docker stack ls 
```

Escale el servicio (el número 6 es la cantidad de replicas que va a tener el servicio escalado)

```bash
  sudo docker service scale mymed_"servicio_que_desea_escalar"=6 
```

Para confirmar cuales son los servicios ejecute
```bash
  sudo docker service ls
```
