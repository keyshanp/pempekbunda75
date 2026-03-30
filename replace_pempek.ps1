Get-ChildItem -Recurse -File | ForEach-Object {  = .FullName;  = Get-Content -Raw -LiteralPath ; if ( -like  *PempekBunda 75*) {  =  -replace PempekBunda 75,PempekBunda 75; if ( -ne ) { Set-Content -LiteralPath  -Value ; Write-Output \updated: \ }}} }

