
################################################################################
##           ROUTERCTRL for Raspberry Pi by Paweł B.                          ##
################################################################################

Info:
Simple tool to control wifi router, USB modems and display informations. 
Feel free to expand this little tool by tweaking with bash, php and simple C code.
################################################################################

Features:
 | Overall displayed informations;
 | - Device temperature
  | - RAM usage
   | - CPU usage
    | - CPU clock speed
     | - Memory usage
      | - System informations
       | - System uptime
 | WiFi Router;
 | - Enable/disable/restart
  | - Display current IP address
   | - Display current network usage
 | USB modems;
 | - Enable/disable/restart
  | - Autoreconnect
   | - Automatically detects USB modem ports
    | - Display connection status
     | - Display network name
      | - Display signal strength (%/dBm/CSQ)
       | - Display current network usage
 | CPU governor switch;
 | - Ondemand/performance/powersave
 | System power menagment;
 | - Poweroff device
  | - Reboot device
 
Control your wifi router by web server or shell commands.
After you install this tool enter http://localhost in your local browser or 
http://10.0.0.1 in your remote machine browser. Default ip addres broadcasting 
is 10.0.0.1.
################################################################################

Settings:
You will need this packages:
  gcc hostapd dnsmasq iptables apache2 php5 libapache2-mod-php5
(Instalation command is included in installation script)

Depending on your USB WiFi adapter you may need to change `driver=rtl871xdrv` in
`hotspot.conf` file and install appropriate driver. Look for hostapd driver for
your USB WiFI adapter. By default its setup for Realtek chipset driver RTL8188CUS.

If you want to change default settings like Router name, before installing open 
`hotspot.conf` file, edit `ssid=RaspberryPi` and `wpa_passphrase=lovemesomepi`. 
RaspberryPi is a router name and lovemesomepi is a password for it.

By default router ip addres is 10.0.0.1, you can change it in `routerctrl` script.

Instalation:
Open terminal window, navigate to `install` file and type `sudo ./install` you 
will be prompted to type you username password. Alternatively, just double-click on 
install file, but you wont be able to see output from installation script and 
you must have gksudo package installed. If installation is done, go to 
http://localhost in browser or type `routerctrl start` to try out if it works. 
################################################################################

Troubleshooting:
Contact me if you encounter any problems.

Note:
If you tried this little tool feel free to mail me and share with me your thoughts.

Thanks for reading.

