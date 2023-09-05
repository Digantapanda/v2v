#-*- coding:utf-8 -*-
import sys
def ceshi(a,b,c):
    d = int(a)+int(b)
    r = int(d)+c
    return r
if __name__ == "__main__":
    res = ceshi(a=sys.argv[1],b=sys.argv[2],c = sys.argv[3])
    print(res)
