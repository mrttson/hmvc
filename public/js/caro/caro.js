$(function() {
    $(document).ready(function() {
        var history = [];
        var token;
        var SIZE = [15, 20];
        var CELL = initArray();
        var TABLE;
        var X = true; // luot danh
        var END = false;
        var WIN_BG_COLOR = 'RED';

        var signal = new Array();
        signal[X] = "X";
        signal[!X] = "O";

        var POINT = new Array();
        POINT[X] = 1;
        POINT[!X] = 2;

        var PERSON = new Array();
        PERSON[X] = "X";
        PERSON[!X] = "Y";

        //Khởi tạo mảng Cell
        function initArray() {
            var i, j;
            var arrCell = new Array();
            for (i = 0; i < SIZE[0]; i++) {
                arrCell[i] = new Array();
                for (j = 0; j < SIZE[1]; j++)
                    arrCell[i][j] = 0;
            }
            return arrCell;
        }

        function loadCell() {
            var c = new Array();
            for (i = 0; i < SIZE[0]; i++) {
                c[i] = new Array();
            }
            var i, cells = $("td");
            for (i = 0; i < cells.length; i++) {
                var cell = cells[i];
                var _pos, _r, _c;
                var r = getAttributes(cell);
                _pos = new String(r["cell"]);
                _r = eval(_pos.split(",")[0]);
                _c = eval(_pos.split(",")[1]);
                c[_r][_c] = cell;
            }

            return c;
        }

        function changeStyle(v) {
            var X = true;
            v = eval(v);
            switch (v) {
                case 2:
                    signal[X] = "X";
                    signal[!X] = "O";
                    break;
                case 3:
                    signal[X] = '<img src="' + img[0] + '">';
                    signal[!X] = '<img src="' + img[1] + '">';
                    break;
                default:
                    signal[X] = '<img src="' + img[0] + '">';
                    signal[!X] = '<img src="' + img[1] + '">';
                    break;
            }
            repaint();
        }

        function repaint() {
            var c, r, p;
            for (var i = 0; i < SIZE[0]; i++) {
                for (var j = 0; j < SIZE[1]; j++) {
                    c = TABLE[i][j];
                    r = getAttributes(c);
                    p = eval(r["point"]);
                    if (p == POINT[X]) {
                        c.innerHTML = signal[X];
                    } else if (p == POINT[!X]) {
                        c.innerHTML = signal[!X];
                    }
                }
            }
        }

        function drawBoard() {
            var i, j;
            sBoard = "<table border='1px'>";
            for (i = 0; i < SIZE[0]; i++) {
                sBoard += "<tr>";
                for (j = 0; j < SIZE[1]; j++) {
                    sBoard += "<td class='cell' cell='" + i + "," + j + "' point=0>&nbsp;</td>";
                }
                sBoard += "</tr>";
            }
            sBoard += "</table>";
            $('#carofield').append(sBoard);
            TABLE = loadCell();
        }
        function addCellEvent() {
            var cells = $("td");
            var i;
            for (i = 0; i < cells.length; i++) {
                cells[i].onclick = function() {
                    if (END) {
                        alert('GAME OVER');
                        return;
                    }
                    var r;
                    r = getAttributes(this);
                    console.log(r["point"]);
                    if (r["point"] != 0) {
                        alert('Ô đã được đánh dấu');
                        return;
                    }
                    X = !X;
                    setPoint(this, POINT[X]);
                    this.innerHTML = signal[X];
                    var _pos, _r, _c;
                    _pos = new String(r["cell"]);
                    _r = eval(_pos.split(",")[0]);
                    _c = eval(_pos.split(",")[1]);
                    CELL[_r][_c] = POINT[X];
                    sendPosition(_r, _c);
                    //-------------------------
                    history.push(_r + ',' + _c);
                    log(_r + "," + _c + " = " + CELL[_r][_c]);
                    //-------------------------
                    var w = checkWin(_r, _c);
                    if (w) {
                        alert(PERSON[X] + " won.");
                    } else {
                        waitPosition();
                    }

                }
            }
        }

        function checkWin(r, c) {
            var i, j;
            var t, v = CELL[r][c], nv, pv;
            var rhead, rtail;
            var chead, ctail;
            // cung hang
            t = 1;
            chead = c;
            rhead = r;
            rtail = r;
            ctail = c;
            for (j = c + 1; j < SIZE[1]; j++) {
                nv = CELL[r][j];
                if (nv == v) {
                    t += 1;
                    ctail = j;
                }
                else
                    break;
            }
            for (j = c - 1; j >= 0; j--) {
                pv = CELL[r][j];
                if (pv == v) {
                    t += 1;
                    chead = j;
                }
                else
                    break;
            }

            if (t >= 5) {
                // highlight
                for (j = chead; j <= ctail; j++) {
                    TABLE[r][j].style.backgroundColor = WIN_BG_COLOR;
                }
                END = true;
                endProcess();
                return true;
            }
            // cung cot
            t = 1;
            chead = c;
            rhead = r;
            rtail = r;
            ctail = c;
            for (i = r + 1; i < SIZE[0]; i++) {
                nv = CELL[i][c];
                if (nv == v) {
                    t += 1;
                    rtail = i;
                }
                else
                    break;
            }
            for (i = r - 1; i >= 0; i--) {
                pv = CELL[i][c];
                if (pv == v) {
                    t += 1;
                    rhead = i;
                }
                else
                    break;
            }
            if (t >= 5) {
                // highlight
                for (i = rhead; i <= rtail; i++) {
                    TABLE[i][c].style.backgroundColor = WIN_BG_COLOR;
                }
                END = true;
                endProcess();
                return true;
            }
            // cheo /
            chead = c;
            ctail = c;
            rhead = r;
            rtail = r;
            t = 1;
            i = r - 1;
            for (j = c + 1; j < SIZE[1]; j++) {
                if (i < 0)
                    break;
                pv = CELL[i--][j];
                if (pv == v) {
                    t += 1;
                    ctail = j;
                    rtail = i + 1;
                }
                else
                    break;
            }
            i = r + 1;
            for (j = c - 1; j >= 0; j--) {
                if (i >= SIZE[0])
                    break;
                pv = CELL[i++][j];
                if (pv == v) {
                    t += 1;
                    chead = j;
                    rhead = i - 1;
                }
                else
                    break;
            }
            if (t >= 5) {
                END = true;
                for (j = chead; j <= ctail; j++) {
                    TABLE[rhead--][j].style.backgroundColor = WIN_BG_COLOR;
                }
                endProcess();
                return true;
            }
            // cheo \
            chead = c;
            ctail = c;
            rhead = r;
            rtail = r;
            t = 1;
            i = r + 1;
            for (j = c + 1; j < SIZE[1]; j++) {
                if (i >= SIZE[0])
                    break;
                pv = CELL[i++][j];
                if (pv == v) {
                    t += 1;
                    ctail = j;
                    rtail = i - 1;
                }
                else
                    break;
            }
            i = r - 1;
            for (j = c - 1; j >= 0; j--) {
                if (i < 0)
                    break;
                pv = CELL[i--][j];
                if (pv == v) {
                    t += 1;
                    chead = j;
                    rhead = i + 1;
                }
                else
                    break;
            }
            if (t >= 5) {
                END = true;
                for (j = chead; j <= ctail; j++) {
                    TABLE[rhead++][j].style.backgroundColor = WIN_BG_COLOR;
                }
                endProcess();
                return true;
            }
        }

        function setPoint(cell, value) {
            cell.attributes.getNamedItem("point").value = value;
        }

        function getAttributes(cell) {
            var r = new Array();
            var cellAttr = cell.attributes;
            for (i = 0; i < cellAttr.length; i++) {
                r[cellAttr[i].name] = cellAttr[i].value;
            }
            return r;
        }

        function log(msg) {
            var c;
            c = $("#state").html();
            c = (c == "") ? (c) : (c + "<br>");
            $("#state").html(c + msg);
        }
        var ajaxWaitDeal = null;
        var ajaxWait = null;
        var ajaxLogin = null;
        drawBoard();

        //Change Style
        $('input[name=setstyle]').click(function() {
            changeStyle($(this).val());
        });

        $("#sendDeal").click(function() {
            var requestSuccess = false;
            if ($('#listPlayerWait').val() != 0) {                
                //ajaxWaitDeal.abort();ajaxWait.abort();ajaxLogin.abort();
                var createRequestDeal = false;
                var userIndex = $(this).val();
                var data = {
                    'requestToken': $('#token1').val(),
                    'recivedToken': $('#listPlayerWait').val(),
                    'lastId': $('#lastId').val()
                };
                console.log(data);
                $.ajax({
                    datatype: 'json',
                    url: "caro/createRequestDeal",
                    type: "POST",
                    data: {data: data},
                    complete: function() {
                        if (requestSuccess == true) {
                            $.ajax({
                                datatype: 'json',
                                url: "caro/waittingResult",
                                type: "POST",
                                data: {data: data},
                                complete: function() {

                                },
                                success: function(res) {
                                    res = JSON.parse(res);
                                    console.log(res);
                                    if (res['position'] == '') {
                                        alert('Hết Giờ');
                                        X = !X;
                                    } else {
                                        var pos = res['position'].split(",");
                                        console.log(pos);
                                        var r = pos[0];
                                        var c = pos[1];
                                        $("td[cell='" + r + "," + c + "']").trigger("click");
                                    }
                                }
                            });
                        }
                    },
                    success: function(res) {
                        res = JSON.parse(res);
                        console.log(res);
                        if (res['success'] == '1') {
                            requestSuccess = true;
                        } else if (res['success'] == '0') {
                            alert('Cannot Request Deal');
                            return false;
                        }
                    }
                });
            }
        });

        $('#login').click(function() {
            addCellEvent();
            var username = $('#loginname').val();
            ajaxLogin = $.ajax({
                datatype: 'json',
                url: "caro/login",
                type: "POST",
                complete: function() {
                    var userToken = $('#token1').val();
                    var requestDealData = null;
                    ajaxWait = $.ajax({
                        datatype: 'json',
                        url: "caro/wait",
                        type: "POST",
                        data: {
                            'token': userToken,
                            'username': username
                        },
                        complete: function() {
                            ajaxWaitDeal = $.ajax({
                                datatype: 'json',
                                url: "caro/waitDeal",
                                type: "POST",
                                data: {'token': userToken},
                                success: function(requestDealData) {
                                    requestDealData = JSON.parse(requestDealData);
                                    $('#requestToken').val(requestDealData['requestToken']);
                                    $('#dealId').val(requestDealData['id']);
                                    $('#acceptRequestDeal').show();
                                }
                            });
                        },
                        success: function(res) {
                            res = JSON.parse(res);
                        }
                    });
                },
                success: function(res) {
                    res = JSON.parse(res);
                    console.log(res);
                    $('#token1').val(res['token']);
                    $('#login').hide();
                }
            });
        });

        function acceptDeal() {
            var dealID = $('#dealId').val();
            $('#token2').val($('#requestToken').val());
            $('#requestToken').hide();
            var data = {'dealID': dealID};
            $.ajax({
                datatype: 'json',
                url: "caro/createDeal",
                type: "POST",
                data: {'data': data},
                complete: function() {
                },
                success: function(res) {
                    res = JSON.parse(res);

                }
            });
        }

        function  declineDeal() {
            var dealID = $('#dealId').val();
            var data = {'requestToken': $('#requestToken').val(), 'recivedToken': $('#token1').val(), 'dealID': dealID};
            $.ajax({
                datatype: 'json',
                url: "caro/createDeal",
                type: "POST",
                data: {'data': data},
                complete: function() {
                },
                success: function(res) {
                    res = JSON.parse(res);

                }
            });
        }

        $('#acceptRequestDeal').click(function() {
            acceptDeal();
        });

        function endProcess() {
            var data = {
                'token1': $('#token1').val(),
                'token2': $('#token2').val(),
                'history': history
            };
            $.ajax({
                datatype: 'json',
                url: "caro/save",
                type: "POST",
                data: {data: data},
                complete: function() {
                    setTimeout(function() {
                        //drawBoard();
                    }, 5000);
                },
                success: function(res) {
                    res = JSON.parse(res);
                    console.log(res);
                }
            });
        }

        function getPlayerWait() {
            $.ajax({
                datatype: 'json',
                url: "caro/reloadPlayerWait",
                type: "POST",
                data: null,
                complete: function() {

                },
                success: function(res) {
                    res = JSON.parse(res);
                    console.log(res);
                    $('#listPlayerWait').html('');
                    $('#listPlayerWait').append('<option value = "0">&nbsp;</option>');
                    $.each(res, function(index, value) {
                        $('#listPlayerWait').append('<option value = "' + value['token'] + '">' + value['name'] + '</option>');
                    });
                }
            });
        }

        $('#getPlayerWait').click(function() {
            getPlayerWait();
        });

        function sendPosition(_r, _c) {
            var dealID = $('#dealId').val();
            var data = {'dealID': dealID, 'p_r': _r, 'p_c': _c};
            $.ajax({
                datatype: 'json',
                url: "caro/sendPosition",
                type: "POST",
                data: data,
                complete: function() {
                },
                success: function(res) {
                    res = JSON.parse(res);
                    console.log(res);
                }
            });
        }
    });
});