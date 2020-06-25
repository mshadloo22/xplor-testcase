data will be persist into a session in backend. so if you refresh page still there is a toy from your set.
there are three arrow for up for left,up(move),right.

this small application is not developed using backend framework or front end framework as it was not in requirements. it is not difficult to set
frameworks and develop in frameworks.


Example Input and Output
------------------------

### Example a

    PLACE 0,0,NORTH
    MOVE
    REPORT

Expected output:

    0,1,NORTH

### Example b

    PLACE 0,0,NORTH
    LEFT
    REPORT

Expected output:

    0,0,WEST

### Example c

    PLACE 1,2,EAST
    MOVE
    MOVE
    LEFT
    MOVE
    REPORT
