@ECHO OFF&PUSHD %~DP0 &TITLE 绿化
>NUL 2>&1 REG.exe query "HKU\S-1-5-19" || (
    ECHO SET UAC = CreateObject^("Shell.Application"^) > "%TEMP%\Getadmin.vbs"
    ECHO UAC.ShellExecute "%~f0", "%1", "", "runas", 1 >> "%TEMP%\Getadmin.vbs"
    "%TEMP%\Getadmin.vbs"
    DEL /f /q "%TEMP%\Getadmin.vbs" 2>NUL
    Exit /b
)

:: 默认更改用户数据保存在当前目录下；
:: reg add HKCU\Software\NetSarang\Common\6 /f /v FirstDataFolder /t REG_DWORD /d 1 >NUL
:: reg add HKCU\Software\NetSarang\Common\6\UserData /f /v UserDataPath /d "%~dp0NetSarang Computer" >NUL

If "%PROCESSOR_ARCHITECTURE%"=="AMD64"  mkdir  "%CommonProgramFiles(x86)%\NetSarang"  2>NUL
If "%PROCESSOR_ARCHITECTURE%"=="AMD64" copy /y XshellCore.tlb "%CommonProgramFiles(x86)%\NetSarang" >NUL 2>NUL

if "%PROCESSOR_ARCHITECTURE%"=="x86" mkdir "%CommonProgramFiles%\NetSarang" 2>NUL
if "%PROCESSOR_ARCHITECTURE%"=="x86" copy /y XshellCore.tlb "%CommonProgramFiles%\NetSarang" >NUL 2>NUL

:: 注册表键值MagicCode为核心检索信息,没有这项键值软件启动不了；

if "%PROCESSOR_ARCHITECTURE%"=="x86" reg add "HKLM\SOFTWARE\NetSarang\Xftp\6" /f /v Path /d "%~dp0\" >NUL 2>NUL
if "%PROCESSOR_ARCHITECTURE%"=="x86" reg add "HKLM\SOFTWARE\NetSarang\Xftp\6" /f /v Version /d "6.0.0089" >NUL 2>NUL
if "%PROCESSOR_ARCHITECTURE%"=="x86" reg add "HKLM\SOFTWARE\NetSarang\License\6\7" /f /v ProductKey /d "180804-116193-999846" >NUL 2>NUL
If "%PROCESSOR_ARCHITECTURE%"=="AMD64" reg add "HKLM\SOFTWARE\Wow6432Node\NetSarang\Xftp\6" /f /v Path /d "%~dp0\" >NUL 2>NUL
If "%PROCESSOR_ARCHITECTURE%"=="AMD64" reg add "HKLM\SOFTWARE\Wow6432Node\NetSarang\Xftp\6" /f /v Version /d "6.0.0089" >NUL 2>NUL
If "%PROCESSOR_ARCHITECTURE%"=="AMD64" reg add "HKLM\SOFTWARE\Wow6432Node\NetSarang\License\6\7" /f /v ProductKey /d "180804-116193-999846" >NUL 2>NUL

if "%PROCESSOR_ARCHITECTURE%"=="x86" reg add "HKLM\SOFTWARE\NetSarang\Xshell\6" /f /v Path /d "%~dp0\" >NUL 2>NUL
if "%PROCESSOR_ARCHITECTURE%"=="x86" reg add "HKLM\SOFTWARE\NetSarang\Xshell\6" /f /v Version /d "6.0.0095" >NUL 2>NUL
if "%PROCESSOR_ARCHITECTURE%"=="x86" reg add "HKLM\SOFTWARE\NetSarang\License\6\7" /f /v ProductKey /d "180804-116193-999846" >NUL 2>NUL
If "%PROCESSOR_ARCHITECTURE%"=="AMD64" reg add "HKLM\SOFTWARE\Wow6432Node\NetSarang\Xshell\6" /f /v Path /d "%~dp0\" >NUL 2>NUL
If "%PROCESSOR_ARCHITECTURE%"=="AMD64" reg add "HKLM\SOFTWARE\Wow6432Node\NetSarang\Xshell\6" /f /v Version /d "6.0.0095" >NUL 2>NUL
If "%PROCESSOR_ARCHITECTURE%"=="AMD64" reg add "HKLM\SOFTWARE\Wow6432Node\NetSarang\License\6\7" /f /v ProductKey /d "180804-116193-999846" >NUL 2>NUL


ECHO.&ECHO 绿化完成！创建快捷方式？
ECHO.&ECHO 是按任意键，否直接关闭！&PAUSE >NUL 2>NUL & CLS

mshta VBScript:Execute("Set a=CreateObject(""WScript.Shell""):Set b=a.CreateShortcut(a.SpecialFolders(""Desktop"") & ""\Xshell.lnk""):b.TargetPath=""%~dp0Xshell.exe"":b.WorkingDirectory=""%~dp0"":b.Save:close")
mshta VBScript:Execute("Set a=CreateObject(""WScript.Shell""):Set b=a.CreateShortcut(a.SpecialFolders(""Desktop"") & ""\Xftp.lnk""):b.TargetPath=""%~dp0Xftp.exe"":b.WorkingDirectory=""%~dp0"":b.Save:close")


ECHO.&ECHO 创建完成！按任意键退出！&PAUSE >NUL 2>NUL & EXIT