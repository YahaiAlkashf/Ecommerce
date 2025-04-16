#include <iostream>
using namespace std;

class AA{
    private: int x;
    public:
    AA(int b) { x+=b; }
    AA(int *y) {cout<<"Y="<<x+*y; }};
    int main()
    {int a=5; AA obj(a); AA obj1(&a); return 0; }
