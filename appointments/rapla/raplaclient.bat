@echo off
cls
::set RAPLA_ENVIRONMENT=-Dorg.rapla.context=/mycontext -Dorg.rapla.serverUrl=http://localhost:8051
call rapla.bat client %1 %2 %3 %4
