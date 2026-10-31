
#!/bin/bash



echo "MONITOREO DEL SERVIDOR"
echo "Fecha y hora:"
date

# Revisión de disco
echo "----------------------"
echo "Uso del disco:"
df -h /

# Memoria usada
echo "----------------------"
echo "Memoria RAM:"
free -h

#  CPU
echo "----------------------"
echo "Uso del CPU:"
top -bn1 | grep "Cpu(s)"

# chekeaa servicios
echo "----------------------"
echo "Servicios:"

systemctl is-active apache2
systemctl is-active ssh

# Revisa errores recientes del seervidor
echo "----------------------"
echo "Errores del servidor:"
journalctl -p err -n 5 --no-pager

echo "----------------------"
echo "Fin del monitoreo"
