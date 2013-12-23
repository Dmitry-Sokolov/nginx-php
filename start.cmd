@echo off
start nginx.exe
start RunHiddenConsole.exe php\php-cgi.exe -b 127.0.0.1:9000 -c php\php.ini
ping 127.0.0.1 -n 1>NUL
echo .
echo ..
echo ...
ping 127.0.0.1 >NUL
EXIT