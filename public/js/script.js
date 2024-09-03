
$(document).ready(function() {
  $('#all-day').change(function() {
      if ($(this).is(':checked')) {
          // 終日のチェックボックスがチェックされた場合
          $('#start-time').hide();  // 開始時間のフィールドを非表示にする
          $('#end-date').hide();  // 終了日のフィールドを非表示にする
          $('#end-time').hide();  // 終了時間のフィールドを非表示にする
          $('#end-label').hide();  // 終了日時のラベルを非表示にする
      } else {
          // 終日のチェックボックスがチェックされていない場合
          $('#start-time').show();  // 開始時間のフィールド表示にする
          $('#end-date').show();  // 終了日のフィールドを表示する
          $('#end-time').show();  // 終了時間のフィールドを表示する
          $('#end-label').show();  // 終了日時のラベルを表示する
      }
  });

  // Todoをクリックしたとき
  $('.todos').hover(function() {
      // 詳細を表示
      $('.detail_ul').show();
      $('#end-date-label').show();
      // クリックされた行のIDを取得
      var id = $(this).data('id');
      
      if (id) {
          // Ajaxでサーバーにリクエストを送信
          $.ajax({
              url: '/Todo/public/get-data/' + id, // Laravelのルートにリクエスト
              method: 'GET',
              success: function(data) {
                  // 取得したデータを表示
                  $('#title').text(data.title);
                  $('#description').text(data.description);
                  $('#place').text(data.place);
                  $('#categories').text(data.categories);
                  $('#priority').text(data.priority);
                  if(data.is_all_day === 1) {
                    $('#start-date').text(data.start_date.replace(/-/g, '/') + " 終日");
                    // $('#end-date-label').hide();
                  } else if(data.start_time){
                    $('#start-date').text(data.start_date.replace(/-/g, '/') + " " + data.start_time);
                  } else {
                    $('#start-date').text(data.start_date.replace(/-/g, '/'));
                  }
                  if(data.end_time){
                    $('#end-date').text(data.end_date.replace(/-/g, '/') + " " + data.end_time);
                  } else {
                    $('#end-date').text(data.end_date.replace(/-/g, '/'));
                  }
              },
              // error: function(jqXHR, textStatus, errorThrown) {
              //   alert('データの取得に失敗しました。ステータス: ' + textStatus + '\nエラー: ' + errorThrown);
              //   console.error('詳細:', jqXHR.responseText);
              // }
          });
      }
  });

  // 完了チェックボックスがクリックされたときの処理
  $('.status_check').on('change', function() {
      // 親の <div> 要素を取得
      var parentDiv = $(this).closest('.todos');
      // 親の <div> 要素の data-id 属性を取得
      var todoId = parentDiv.data('id');
      var status = $(this).is(':checked') ? '完了' : '予定';

      // AJAXでステータスを更新する
      $.ajax({
          url: '/Todo/public/update-status',  // ステータスを更新するルートを指定
          method: 'POST',
          data: {
              id: todoId,
              status: status,
              // _token: '{{ csrf_token() }}' // LaravelのCSRFトークン
              _token: $('meta[name="csrf-token"]').attr('content') // CSRFトークンを含める
          },
          // success: function(response) {
          //     alert('ステータスが更新されました: ' + status);
          // },
          // error: function(jqXHR, textStatus, errorThrown) {
          //     alert('ステータスの更新に失敗しました。ステータス: ' + textStatus + '\nエラー: ' + errorThrown);
          //     console.error('詳細:', jqXHR.responseText);
          // }
      });
  });

});

