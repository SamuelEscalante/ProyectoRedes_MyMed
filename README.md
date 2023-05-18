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