@echo off
cls
::set RAPLA_ENVIRONMENT=org.rapla.context=/mycontext
echo WARNING: Importing data. Destination database will be overwritten. jetty.xml is used. Check file and sql settings
pause
call rapla.bat import %1 %2 %3 %4
pause
