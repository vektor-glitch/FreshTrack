# Setup Task Scheduler untuk FreshTrack Email Reminder
# Jalankan script ini sebagai Administrator

# Cek apakah dijalankan sebagai Administrator
if (-NOT ([Security.Principal.WindowsPrincipal][Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)) {
    Write-Host "ERROR: Script harus dijalankan sebagai Administrator!" -ForegroundColor Red
    Write-Host "Cara: Klik kanan PowerShell -> 'Run as administrator', kemudian jalankan lagi." -ForegroundColor Yellow
    exit 1
}

Write-Host "=== Setup Task Scheduler FreshTrack ===" -ForegroundColor Cyan
Write-Host ""

# Define variables
$taskName = "FreshTrack Email Reminder"
$phpPath = "C:\xampp\php\php.exe"
$scriptPath = "c:\xampp\htdocs\Kuis-ResponsiPWD\FreshTrack\cron\send_reminders.php"
$workingDir = "c:\xampp\htdocs\Kuis-ResponsiPWD\FreshTrack\cron"
$taskTime = "08:00AM"

# Check if PHP exists
if (-NOT (Test-Path $phpPath)) {
    Write-Host "ERROR: PHP tidak ditemukan di: $phpPath" -ForegroundColor Red
    exit 1
}

# Check if script exists
if (-NOT (Test-Path $scriptPath)) {
    Write-Host "ERROR: Script tidak ditemukan di: $scriptPath" -ForegroundColor Red
    exit 1
}

# Try to remove old task
Write-Host "Menghapus task lama (jika ada)..." -ForegroundColor Yellow
try {
    Unregister-ScheduledTask -TaskName $taskName -Confirm:$false -ErrorAction SilentlyContinue
    Start-Sleep -Seconds 1
    Write-Host "✓ Task lama dihapus" -ForegroundColor Green
} catch {
    Write-Host "✓ Tidak ada task lama" -ForegroundColor Green
}

# Create new task
Write-Host ""
Write-Host "Membuat task scheduler baru..." -ForegroundColor Yellow

try {
    $action = New-ScheduledTaskAction `
        -Execute $phpPath `
        -Argument $scriptPath `
        -WorkingDirectory $workingDir

    $trigger = New-ScheduledTaskTrigger `
        -Daily `
        -At $taskTime

    $settings = New-ScheduledTaskSettingsSet `
        -AllowStartIfOnBatteries `
        -DontStopIfGoingOnBatteries `
        -StartWhenAvailable

    Register-ScheduledTask `
        -Action $action `
        -Trigger $trigger `
        -Settings $settings `
        -TaskName $taskName `
        -Description "Mengirim email notifikasi kedaluwarsa bahan makanan FreshTrack" `
        -Force

    Write-Host ""
    Write-Host "✓ Task scheduler berhasil dibuat!" -ForegroundColor Green
    Write-Host ""
    Write-Host "=== Informasi Task ===" -ForegroundColor Cyan
    Write-Host "Nama Task: $taskName"
    Write-Host "Waktu Jalan: Setiap hari jam $taskTime"
    Write-Host "Program: $phpPath"
    Write-Host "Script: $scriptPath"
    Write-Host ""
    Write-Host "=== Testing ===" -ForegroundColor Cyan
    Write-Host "Untuk test sekarang, jalankan:"
    Write-Host "  php $scriptPath" -ForegroundColor White
    Write-Host ""
    Write-Host "Untuk melihat task di Task Scheduler:"
    Write-Host "  1. Tekan Win + R"
    Write-Host "  2. Ketik: taskschd.msc"
    Write-Host "  3. Cari: $taskName" -ForegroundColor White

} catch {
    Write-Host "ERROR: Gagal membuat task!" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
    exit 1
}
