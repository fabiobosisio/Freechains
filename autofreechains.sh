#!/bin/bash

HOSTS=(
    francisco-santanna.duckdns.org
    lcc-uerj.duckdns.org
    #raspbosisio.duckdns.org
)

CHAINS=(
    "#"
    "#br"
    #"#mail"
    "@A2885F4570903EF5EBA941F3497B08EB9FA9A03B4284D9B27FF3E332BA7B6431"
    "@74F330FE3EE1051CF5D01DDAA3E4B92243AB65579BE209ABA374161036F134D7"
)

for host in "${HOSTS[@]}"
do
    for chain in "${CHAINS[@]}"
    do
        echo -n "Send to   $host $chain:    "
        freechains peer $host send $chain
        echo -n "Recv from $host $chain:    "
        freechains peer $host recv $chain
    done
done