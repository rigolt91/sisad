<<<_END
                    Dim WinScriptHost
                    Set WinScriptHost = CreateObject('WScript.Shell')
                    WinScriptHost.Run Chr(34) & 'D:\LARAGON\www\project-sisad\schtasks\iniciar.bat' & Chr(34), 0
                    Set WinScriptHost = Nothing
                _END