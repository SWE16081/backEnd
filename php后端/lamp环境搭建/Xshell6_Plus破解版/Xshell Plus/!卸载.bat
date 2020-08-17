@ECHO OFF& TITLE 卸载
taskkill /f /im Xshell* >NUL 2>NUL

rd/s/q "%ProgramData%\NetSarang" 2>NUL
rd/s/q "%AllUsersProfile%\NetSarang"2>NUL
reg delete HKCU\Software\NetSarang /F>NUL 2>NUL
reg delete HKLM\SOFTWARE\NetSarang /F>NUL 2>NUL
reg delete HKLM\SOFTWARE\Wow6432Node\NetSarang /F>NUL 2>NUL
del /q "%userprofile%\桌面\Xshell.lnk" >NUL  2>NUL 
del /q "%userprofile%\Desktop\Xshell.lnk" >NUL  2>NUL 

ECHO.&ECHO 卸载完成！是否删除用户数据？
ECHO.&ECHO 如果自定义的路径请手动删除。
ECHO.&ECHO 是请按任意键，否直接关闭呗！&PAUSE >NUL 2>NUL & CLS

for /f "skip=2 tokens=3 delims= " %%i in ('reg query "HKCU\Software\Microsoft\Windows\CurrentVersion\Explorer\User Shell Folders" /v personal') do (
       for /f "delims=*" %%j in ('echo %%i') do rd/s/q "%%j\NetSarang" 2>NUL)
       

ECHO.&ECHO 卸载完成！按任意键退出！&PAUSE >NUL 2>NUL & EXIT