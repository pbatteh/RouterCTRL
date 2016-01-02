#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

int main ( int argc, char *argv[] )
{
    char * ch= (char*)malloc(64);
    memset(ch, 0, 64); 
    if (argv[1]!=NULL) {
	sprintf(ch, "/etc/init.d/routerctrl %s", argv[1]);
	if (argv[2]!=NULL) { 
	sprintf(ch, "%s %s", ch, argv[2]);
	if (argv[3]!=NULL) sprintf(ch, "%s %s", ch, argv[3]);
	}
	}
    setuid( 0 );   
    system(ch);
    free(ch);
    return 0;
 }

