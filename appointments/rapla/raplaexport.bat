@echo off
cls
::set RAPLA_ENVIRONMENT=org.rapla.context=/mycontext
echo WARNING: Exporting data. Destination file will be overwritten. jetty.xml is used. Check file and sql settings.
pause
call rapla.bat export %1 %2 %3 %4
pause
