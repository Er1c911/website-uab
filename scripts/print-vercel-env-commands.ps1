# Prints `vercel env add` commands using values from .env
# Usage: open PowerShell in repo root and run: .\scripts\print-vercel-env-commands.ps1
# This script DOES NOT execute vercel CLI; it only prints commands for you to copy-paste.

$dotenvPath = Join-Path (Get-Location) ".env"
if (-not (Test-Path $dotenvPath)) {
    Write-Error ".env not found in repository root."
    exit 1
}

# Keys to export to Vercel (production)
$keys = @(
    'APP_KEY', 'APP_DEBUG',
    'DB_HOST','DB_PORT','DB_DATABASE','DB_USERNAME','DB_PASSWORD',
    'APP_URL'
)

$lines = Get-Content $dotenvPath | Where-Object { $_ -match '=' -and -not ($_ -match '^[#]') }
$env = @{}
foreach ($line in $lines) {
    $parts = $line -split '=',2
    if ($parts.Count -eq 2) {
        $k = $parts[0].Trim()
        $v = $parts[1].Trim()
        $env[$k] = $v
    }
}

Write-Output "# Run these commands after you log in with 'vercel login' and have selected the correct project"
Write-Output "# They will add production env vars to your Vercel project."
Write-Output "# Note: This prints commands — do NOT paste these into a public place. Rotate secrets afterwards."
Write-Output ""

foreach ($k in $keys) {
    if ($env.ContainsKey($k)) {
        $val = $env[$k]
        # Escape double quotes in value
        $valEsc = $val -replace '"', '""'
        Write-Output "vercel env add $k \"$valEsc\" production"
    } else {
        Write-Output "# SKIP: $k not found in .env"
    }
}

Write-Output ""
Write-Output "# After adding env vars, redeploy or visit Vercel dashboard to trigger a new deployment."
Write-Output "# To view logs: vercel logs <deployment-url> --since 1h --prod"