


$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
  }
});


// // 1.検索

  $(function () {

  $('#search').on('click', function(e) {
    e.preventDefault();

  $.ajax({
     data: $('#product_search').serialize(),
     url: "search",
     type: 'GET',
     dataType: "html"
  }).done(function (data) {
     let newtable = $(data).find('#product_table');
     $('#product_table').html(newtable);

     $('#myTable').tablesorter().trigger('update').trigger('sorton', [[[0,0]]]);

  }).fail(function (data) {
     alert('データ取得出来ませんでした。');
  });
 });
});
// 3 ソート
 $(document).ready(function() {
  $('#myTable').tablesorter();
 });




    // 4.削除
  //   $(function() {
  //     $('.delete').on('click', function(e) {
  //       e.preventDefault();
  //       var deleteConfirm = confirm('削除してよろしいでしょうか？');

  //   //削除ボタンに"delete"クラスを設定しているため、ボタンが押された場合に開始されます
  //       if(deleteConfirm == true) {
  //         var clickEle = $(this)
  //         //メッセージをOKした時（true)の場合、次に進みます
  //           //$(this)は自身（今回は押されたボタンのinputタグ)を参照します
  //               // 削除ボタンにユーザーIDをカスタムデータとして埋め込んでます。
  //   //"clickEle"に対して、inputタグの設定が全て代入されます
  //         var productID = clickEle.attr('data-product_id');
  //     //attr()」は、HTML要素の属性を取得したり設定することができるメソッドです
  //     //今回はinputタグの"data-user_id"という属性の値を取得します
  //     //"data-user_id"にはレコードの"id"が設定されているので
  //     // 削除するレコードを指定するためのidの値をここで取得します

  //     // .ajaxメソッドでルーティングを通じて、コントローラへ非同期通信を行います。
  //   //見本ではレコードを削除するコントローラへ通信を送るためにはweb.phpを参照すると
  //   //通信方法は"post"に設定し、URL（送信先）を'/destroy/{id}'にする必要があります
  //  $.ajax({
  //           type: 'POST',
  //           url: '/Ct_project/public/destroy/' + productID,//productID にはレコードのIDが代入されています
  //           dataType: 'html',
  //           headers: {
  //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //           },
  //           data: {'id':productID,

  //                 },// DELETE リクエストだよ！と教えてあげる。
  //         })
  //         .done(function(data) {
  //           // 通信が成功した場合、クリックした要素の親要素の <tr> を削除
  //           clickEle.parents('tr').remove();

  //         })
  //         .fail(function(data) {
  //           alert('エラー');
  //         });
  //       } else {
  //         (function(e) {
  //           //”削除しても良いですか”のメッセージで”いいえ”を選択すると次に進み処理がキャンセルされます
  //           e.preventDefault()
  //         });
  //       };
  //     });
  //   });
  //   //  .ajaxメソッドではオプション（引数）を設定することで送信先（URL)や送信する変数を指定できます

  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var deleteConfirm = confirm('削除してよろしいでしょうか？');
    if(deleteConfirm == true) {
       var clickEle = $(this);
       var productID = clickEle.attr('data-product_id');
       $.ajax({
         type: 'POST',
         url: '/Ct_project/public/destroy/' + productID,
         dataType: 'html',
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data: {'id':productID},
       })
       .done(function(data) {
         clickEle.parents('tr').remove();
       })
       .fail(function(data) {
         alert('エラー');
       });
    }
   });