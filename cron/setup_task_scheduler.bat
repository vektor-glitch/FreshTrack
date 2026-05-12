@echo off
REM Setup Task Scheduler untuk FreshTrack
REM Script ini akan menjalankan PowerShell script as Administrator

echo.
echo ====================================
echo  FreshTrack Task Scheduler Setup
echo ====================================
echo.

REM Get the directory where this batch file is located
set SCRIPT_DIR=%~dp0

REM Run PowerShell as Administrator
powershell -NoProfile -ExecutionPolicy Bypass -Command "& {Start-Process powershell -ArgumentList '-NoProfile -ExecutionPolicy Bypass -File \"%SCRIPT_DIR%setup_task_scheduler.ps1\"' -Verb RunAs}"

pause
