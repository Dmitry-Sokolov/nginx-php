@echo off
start D:\nginx\nginx.exe
start D:\nginx\RunHiddenConsole.exe D:\nginx\php\php-cgi.exe -b 127.0.0.1:9000 -c D:\nginx\php\php.ini
ping 127.0.0.1 -n 1>NUL
echo .
echo ..
echo ...
ping 127.0.0.1 >NUL
EXIT