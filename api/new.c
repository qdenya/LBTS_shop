#include <stdio.h>

void swap(int arr[2][100001], int left, int right)
{
    int tmp = arr[0][left];
    int tmp_num = arr[1][left];
    arr[0][left] = arr[0][right];
    arr[1][left] = arr[1][right];
    arr[0][right] = tmp;
    arr[1][right] = tmp_num;
}

void moveUp(int arr[2][100001], int ind)
{
    int parent = ind / 2;
    if (ind > 1 && arr[0][ind] > arr[0][parent])
    {
        swap(arr, ind, parent);
        moveUp(arr, parent);
    }
}

int check(int arr[2][100001], int left, int right)
{
    if (arr[0][left] > arr[0][right])
    {
        return 1;
    }
    if (arr[0][left] == arr[0][right])
    {
        if (arr[1][left] < arr[1][right])
        {
            return 1;
        }
    }
    return 0;
}

void moveDown(int arr[2][100001], int ind, int heapsize)
{
    int left = ind * 2;
    int right = ind * 2 + 1;

    int toChange = ind;

    int A = 0, B = 0;

    A = left <= heapsize;
    B = right <= heapsize;

    if (A && B)
    {
        printf("\n A B");
        if (check(arr, left, right))
        {
            if (check(arr, left, ind))
            {
                swap(arr, left, ind);
                moveDown(arr, left, heapsize);
                return;
            }
        }
        else
        {
            if (check(arr, right, ind))
            {
                swap(arr, right, ind);
                moveDown(arr, right, heapsize);
                return;
            }
        }
        return;
    }

    if (A)
    {
        printf("\n A");
        if (check(arr, left, ind))
        {
            swap(arr, left, ind);
            moveDown(arr, left, heapsize);
            return;
        }
        return;
    }

    if (B)
    {
        printf("\n B");
        if (check(arr, right, ind))
        {
            swap(arr, right, ind);
            moveDown(arr, right, heapsize);
            return;
        }
        return;
    }
}

void printNow(int arr[2][100001], int heapsize)
{
    printf("\nNow: ");
    for (int i = 1; i < heapsize; i++)
    {
        printf("%d {%d} ", arr[0][i], arr[1][i]);
    }
    printf("\n");
}

int main()
{
    int arr[2][100001];

    int count = 1;    //Уникальный id для построения дерева
    int position = 1; //Количество сейчас в дереве (начинаем от 1)
    int a, b;

    scanf("%d", &a);

    for (int i = 0; i < a; i++)
    {
        scanf("%d", &b);
        switch (b)
        {
        case 0:
            if (position > 1)
            {
                position--;
                arr[0][1] = arr[0][position];
                printf("%d\n", arr[1][1]);
                arr[1][1] = arr[1][position];
                moveDown(arr, 1, position);
            }
            break;
        default:
            arr[0][position] = b;
            arr[1][position] = count;
            moveUp(arr, position);
            count++;
            position++;
            break;
        }
        printNow(arr, position);
    }

    return 0;
}
