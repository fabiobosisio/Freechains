#!/usr/bin/env python
# -*- coding: utf-8 -*-

# Importar modulo do sistema operacional
import os

# Importar modulo de tratamento de json
import json

# Importar o objeto datetime do modulo datetime para obter data e hora do sistema
from datetime import datetime

import sys

#Endereco onde o JSON sera salvo
local = '/mnt/RAM/wikichain.json'
#local = '/tmp/wikichain.json'

# Usa o comando do shell ls
#Apaga a tela
os.system("clear")

def get_genesis(name):
    # Obtem o bloco genesis da cadeia
    cadeia = 'freechains chain "'+name+'" genesis'
    genesis = os.popen(cadeia).read()
    print ("Genesis da cadeia "+name+" : ",genesis)
    return genesis

def get_cadeia(name):
    chain_dict = {}
    i = 0
    genesis = get_genesis(name)
    while True:
        # Obtem o primeiro bloco
        cmd = 'freechains chain "'+name+'" get block '+ genesis #Monta o comando
        bloco = os.popen(cmd).read() #Executa o comando no terminal e obtem o Bloco como resultado
        parsed_json = json.loads(bloco) #formata como JSON
        try:
            front = parsed_json['fronts'][0] #Parseia o primeiro elemento do array fronts
            cmd = 'freechains chain "'+name+'" get payload '+ front
            pay = os.popen(cmd).read() #Executa o comando no terminal e obtem o Payload como resultado
            if parsed_json['like'] is None:
                lik = 0
            else:            
                lik = parsed_json['like']
            print("Front[",i,"]: ", front)
            print("Like[",i,"]: ", lik)
            print("Payload[",i,"]: ", pay)                 
            chain_dict[i] = {"Front":front, "Likes":lik, "Payload":pay}
            genesis = front
            i += 1
        except:
            return chain_dict
        

def make_json(name):
    final_dict = {}
    i = 0
    atualizado = datetime.now().strftime('%d-%m-%Y %H:%M:%S')
    final_dict = ({'Updated':atualizado,})
    if name:
        for x in name:
            chain1_dict = get_cadeia(x)     
#            n = 'Entry '+str(i)
            n = name[i][1:]
            final_dict.update({n:chain1_dict},)
            i += 1
            print('Cadeia: ',x,' processada\n')
    else:
        print('Inclua pelomenos uma cadeia como argumento')
        sys.exit()   
    print ('La vai: ',final_dict)
    with open(local, 'w') as json_file: #So em SUDO       
        json.dump(final_dict, json_file, indent=4)
    print ("JSON gerado em:", atualizado)

# Faz a magica acontecer
make_json(sys.argv[1:])
#teste = ['wiki', 'wiki']
#make_json(teste)

       