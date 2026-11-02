@echo off
cd /d "%~dp0"
where php >nul 2>nul
if errorlevel 1 (
  echo PHP nao foi encontrado no PATH.
  echo Instale PHP ou use o terminal do XAMPP e tente novamente.
  pause
  exit /b 1
)
echo Iniciando UniHelp em http://localhost:8000
start "UniHelp" cmd /k "php -S localhost:8000"
timeout /t 2 /nobreak >nul
start "" http://localhost:8000
