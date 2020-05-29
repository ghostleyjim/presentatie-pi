#! /usr/bin/env python3
import time
import os.path
from os import path
from datetime import datetime
import subprocess


d = datetime.now()
cmd_start_ppt = ["libreoffice", "--nologo", "--norestore", "--show", "/var/www/html/presentation/current_presentation.pps"]
#cmd_start_pptx = ["libreoffice", "--nologo", "--norestore", "--show", "/var/www/html/presentation/current_presentation.pptx"]
cmd_kill = ["pkill", "soffice.bin"]
cmd_screen_off = "tvservice -o"
cmd_screen_on = "tvservice -p"

os.system("export DISPLAY=:0.0")

def presentatiecheck():
    while True:
        if path.exists("/var/www/html/presentation/new_presentation.pptx"):
            startpresentatie("pptx")
        if path.exists("/var/www/html/presentation/new_presentation.pps"):
            startpresentatie("pps")
        if datetime.time(d).hour == 18:
            os.system(cmd_screen_off)
        if datetime.time(d).hour == 8:
            os.system(cmd_screen_on)
        time.sleep(10)


def startpresentatie(filetype):
    if filetype == "pps":

        if path.exists("/var/www/html/presentation/current_presentation.pps"):
            os.remove("/var/www/html/presentation/current_presentation.pps")
        os.rename('/var/www/html/presentation/new_presentation.pps', '/var/www/html/presentation/current_presentation.pps')
        try:
            subprocess.run(cmd_kill)
        except:
            pass
        print("killing soffice.bin")
        subprocess.Popen(cmd_start_ppt)
        print("start pps")
    # if filetype == "pptx":
    #     if path.exists("/var/www/html/presentation/current_presentation.pptx"):
    #         os.remove("/var/www/html/presentation/current_presentation.pptx")
    #     os.rename('/var/www/html/presentation/new_presentation.pptx', '/var/www/html/presentation/current_presentation.pptx')
    #     try:
    #         subprocess.run(cmd_kill)
    #     except:
    #         pass
    #     print("killing soffice.bin")
    #     subprocess.Popen(cmd_start_pptx)
    #     print("start pptx")
    # presentatiecheck()

if __name__ == '__main__':
    presentatiecheck()
