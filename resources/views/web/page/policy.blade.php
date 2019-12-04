<?php
use App\Library\Helpers;
$titleMeta = 'Chính sách Chia Sẻ Nhạc';
?>
@section('meta')
    <meta name="copyright" content="{{env('APP_URL')}}" />
    <meta name="revisit-after" content="7 Days">
    <meta name="keywords" content="bang xep hang, music, mp3, m4a, flac, lossless, video, mv, hd, mp4, csn, nghe nhạc, tải nhạc, lời bài hát, lyrics">
    <meta name="description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless.">
    <link rel="canonical" href="{{url()->current()}}" />
    <link rel="image_src" href="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta name="title" content="Chính sách Chia Sẻ Nhạc" />
    <meta property="og:image" content="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$titleMeta}}" />
    <meta property="og:description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless." />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@extends('web.layouts.app')
@section('contentCSS')
@endsection
@section('content')
    <div class="container">
        <div class="row row_wrapper">
            <div class="col-md-9">
                <div class="tab-content" id="myTabContent">
                    <p style="font-family: 'SFProDisplay-Regular'; color: #333; font-size: 14px;">
                        I. Nội dung – Điều khoản sử dụng dịch vụ<br>
                        1. Nội dung dịch vụ<br>
                        - CÔNG TY CỔ PHẦN GIẢI TRÍ YÊU CA HÁT cung cấp cho người sử dụng dịch vụ mạng xã hội chiasenhac.vn các chủ đề âm nhạc.<br>
                        -	Chiasenhac.vn cung cấp dịch vụ cho Người Sử Dụng trao đổi thông qua công cụ chat bao gồm chat bằng kí tự, hình ảnh.<br>
                        -	Chiasenhac.vn cho phép người dùng truy cập và sử dụng sản phẩm trên website hoặc/và trên các ứng dụng phát triển trong tương lai.<br>
                        -	Chiasenhac.vn cung cấp nền tảng để bên thứ 3 chủ động sản xuất nội dung cung cấp tới Người Sử Dụng. Bên thứ 3 phải tuân thủ các điều kiện, quy định trong Thỏa Thuận này và Thỏa Thuận Hợp Tác hai bên.<br>
                        2. Điều khoản sử dụng<br>
                        -	Để truy cập và thưởng thức Dịch vụ chiasenhac.vn Người Sử Dụng phải đồng ý và tuân theo các điều khoản được quy định tại Thỏa thuận này và quy định, quy chế mà chiasenhac.vn liên kết, tích hợp bao gồm.<br>
                        -	Khi truy cập, sử dụng Chiasenhac.vn bằng bất cứ phương tiện (máy tính, điện thoại, tivi thiết bị kết nối internet) hoặc sử dụng ứng dụng chiasenhac.vn thì Người Sử Dụng cũng phải tuân theo Quy chế này.<br>
                        -	Để đáp ứng nhu cầu sử dụng của Người Sử Dụng, chiasenhac.vn không ngừng hoàn thiện và phát triển, vì vậy các điều khoản quy định tại Thỏa thuận cung cấp và sử dụng dịch vụ phát và xem chiasenhac, Quy chế có thể được cập nhật, chỉnh sửa bất cứ lúc nào mà không cần phải thông báo trước tới Người Sử Dụng. chiasenhac sẽ công bố rõ trên Website, diễn đàn về những thay đổi, bổ sung đó.<br>
                        <br>
                        II. Đăng kí tài khoản và sử dụng dịch vụ<br>
                        1.  Người Sử Dụng tự chịu chiasenhac.vn.<br>
                        2.  Sau khi Người Sử Dụng đăng nhập vào hệ thống, Người Sử Dụng có thể thay đổi tên thành viên. Tên thành viên phải tuân theo nội quy đặt tên theo quy định, không vi phạm những điều cấm của Thỏa thuận này.<br>
                        3.  Một số tính năng yêu cầu Người Sử Dụng phải đăng ký, đăng nhập để sử dụng. Nếu Người Sử Dụng không đăng ký, đăng nhập thì chỉ sử dụng được các tính năng thông thường. Chúng tôi khuyến khích Người Sử Dụng đăng ký tài khoản để sử dụng đầy đủ các tính năng trên hệ thống website chiasenhac.vn được tốt nhất.<br>
                        4.  Trên Website của hệ thống chiasenhac.vn xuất hiện link website, hoặc biểu tượng website khác, những website này không thuộc kiểm soát hoặc sở hữu của chiasenhac.vn. Việc truy cập tới các trang khác này hoàn toàn có thể gặp rủi ro, nguy hiểm. Người Sử Dụng hoàn toàn chịu trách nhiệm rủi ro khi sử dụng website liên kết này. Chiasenhac.vn sẽ không chịu trách nhiệm về nội dung của bất kì website hoặc điểm đến nào ngoài trang hệ thống các trang web của Chiasenhac.vn.<br>
                        <br>
                        III. Các nội dung cấm trao đổi và chia sẻ trên mạng xã hội<br>
                        Khi sử dụng các dịch vụ của hệ thống Chiasenhac.vn, nghiêm cấm người sử dụng thực hiện một số hành vi bao gồm nhưng không giới hạn sau:<br>
                        1.  Lợi dụng việc cung cấp, trao đổi, sử dụng thông tin trên Chiasenhac.vn nhằm mục đích:<br>
                        - Chống lại Nhà nước Cộng hoà xã hội chủ nghĩa Việt Nam; gây phương hại đến an ninh quốc gia, trật tự, an toàn xã hội; phá hoại khối đại đoàn kết toàn dân; tuyên truyền chiến tranh xâm lược, khủng bố; gây hận thù, mâu thuẫn giữa các dân tộc, sắc tộc, chủng tộc, tôn giáo;<br>
                        - Tuyên truyền, kích động bạo lực, dâm ô, đồi trụy, tội ác, tệ nạn xã hội, mê tín dị đoan, phá hoại thuần phong, mỹ tục của dân tộc.<br>
                        - Tuyệt đối không bàn luận, đăng tải các nội dung về các vấn đề chính trị.<br>
                        2.  Người Sử Dụng lợi dụng việc sử dụng hệ thống Chiasenhac.vn nhằm tiết lộ bí mật nhà nước, bí mật quân sự, an ninh, kinh tế, đối ngoại và những bí mật khác do pháp luật quy định bằng bất cứ hình thức nào trên hệ thống Chiasenhac.vn <br>
                        3.  Quảng cáo, tuyên truyền, mua bán hàng hoá, dịch vụ bị cấm hoặc truyền bá tác phẩm báo chí, văn học, nghệ thuật, xuất bản phẩm bị cấm trên Chiasenhac.vn 4.  Khi giao tiếp với người dùng khác, Người Sử Dụng quấy rối, chửi bới, làm phiền hay có bất kỳ hành vi thiếu văn hoá.<br>
                        5.  Người Sử Dụng có quyền sử dụng đối với hình ảnh của mình. Khi sử dụng hình ảnh của cá nhân khác, Người Sử Dụng phải được sự đồng ý của cá nhân đó. Nghiêm cấm việc sử dụng hình ảnh của người khác mà xâm phạm danh dự, nhân phẩm, uy tín của người có hình ảnh.<br>
                        6.  Lợi dụng mạng xã hội Chiasenhac.vn để thu thập thông tin của Người Sử Dụng, công bố thông tin, tư liệu về đời tư của Người Sử Dụng khác.<br>
                        7.  Đặt tên thành viên theo tên của danh nhân, tên các vị lãnh đạo của Đảng và Nhà nước, tên của cá nhân, tổ chức tội phạm, phản động, khủng bố hoặc tài khoản có ý nghĩa không lành mạnh, trái với thuần phong mỹ tục.<br>
                        8.  Đưa thông tin xuyên tạc, vu khống, nhạo báng, xúc phạm uy tín tới tổ chức, cá nhân dưới bất kỳ hình thức nào (nhạo báng, chê bai, kỳ thị tôn giáo, giới tính, sắc tộc….).<br>
                        9.  Nghiêm cấm quảng bá bất kỳ sản phẩm dưới bất kỳ hình thức nào, bao gồm nhưng không giới hạn việc gửi, truyền bất kỳ thông điệp nào mang tính quảng cáo, mời gọi, thư dây truyền, cơ hội đầu tư trên Chiasenhac.vn.<br>
                        10. Lợi dụng Chiasenhac.vn để tổ chức các hình thức cá cược, cờ bạc hoặc các thỏa thuận liên quan đến tiền, hiện kim, hiện vật.<br>
                        11. Cản trở trái pháp luật, gây rối, phá hoại hệ thống máy chủ; Cản trở việc truy cập thông tin và sử dụng các dịch vụ hợp pháp trên Chiasenhac.vn.<br>
                        12. Sử dụng trái phép mật khẩu, khoá mật mã của các tổ chức, cá nhân, thông tin riêng, thông tin cá nhân và tài nguyên Internet.<br>
                        13. Trực tiếp hoặc gián tiếp sử dụng bất kỳ thiết bị, phần mềm, trang web internet, dịch vụ dựa trên web, hoặc các phương tiện khác để gỡ bỏ, thay đổi, bỏ qua, lẩn tránh, cản trở, hoặc phá hoại bất kỳ bản quyền, thương hiệu, hoặc các dấu hiệu về quyền sở hữu khác được đánh dấu trên Nội dung (như logo) hoặc bất kỳ hệ thống kiểm soát dữ liệu, thiết bị, biện pháp bảo vệ nội dung khác cũng như các biện pháp hạn chế truy cập từ các vùng địa lý khác nhau.<br>
                        14. Trực tiếp hoặc gián tiếp thông qua bất kỳ thiết bị, phần mềm, trang web internet, dịch vụ dựa trên web, hoặc các phương tiện khác để sao chép, tải về, chụp lại, sản xuất lại, nhân bản, lưu trữ, phân phối, tải lên, xuất bản, sửa đổi, dịch thuật, phát sóng, trình chiếu, hiển thị, bán, truyền tải hoặc truyền lại nội dung.<br>
                        15. Tạo ra, tái tạo, phân phối hay quảng cáo một chi tiết của bất kỳ nội dung mà không có sự đồng ý của Chiasenhac.vn. Bạn không được phép xây dựng mô hình kinh doanh sử dụng các Nội dung cho dù là có hoặc không vì lợi nhuận. Nội dung được đề cập tại Chiasenhac.vn bao gồm nhưng không giới hạn bất kỳ văn bản, đồ họa, hình ảnh, bố trí, giao diện, biểu tượng, hình ảnh, tài liệu âm thanh và video, và ảnh tĩnh. Ngoài ra, chúng tôi nghiêm cấm việc tạo ra các sản phẩm phát sinh hoặc vật liệu có nguồn gốc từ hoặc dựa trên bất kì Nội dung nào bao gồm dựng phim, làm video tương tự, hình nền, chủ đề máy tính, thiệp chúc mừng, và hàng hóa.<br>
                        16. Giả mạo tổ chức, cá nhân và phát tán thông tin giả mạo, thông tin sai sự thật trên Chiasenhac.vn xâm hại đến quyền và lợi ích hợp pháp của tổ chức, cá nhân.<br>
                        17. Tạo đường dẫn trái tới tên miền hợp pháp của tổ chức, cá nhân. Tạo, cài đặt, phát tán các phần mềm độc hại, vi rút máy tính; xâm nhập trái phép, chiếm quyền điều khiển hệ thống thông tin, tạo lập công cụ tấn công trên Internet.<br>
                        18. Tuyệt đối không sử dụng bất kỳ chương trình, công cụ hay hình thức nào khác để can thiệp vào hệ thống Chiasenhac.vn.<br>
                        19. Không được có bất kỳ hành vi nào nhằm đăng nhập trái phép hoặc tìm cách đăng nhập trái phép hoặc gây thiệt hại cho hệ thống máy chủ Chiasenhac.vn<br>
                        <br>
                        IV. Quy tắc quản lí xử phạt vi phạm người dùng<br>
                        1.   Các nguyên tắc đối với người sử dụng:<br>
                        -	Người Sử Dụng vi phạm thỏa thuận cung cấp và sử dụng mạng xã hội thì tùy theo mức độ nghiêm trọng của hành vi vi phạm sẽ bị xử phạt tương ứng.<br>
                        -	Trường hợp hành vi vi phạm của Người Sử Dụng chưa được quy định trong thỏa thuận này thì tùy vào tính chất, mức độ của hành vi vi phạm Chiasenhac.vn sẽ đơn phương, toàn quyền quyết định mức xử phạt hợp lý.<br>
                        -	Hình thức xử phạt khóa tài khoản có thời hạn hoặc vĩnh viễn.<br>
                        -	Các hình thức xử phạt: <br>
                        + Hình thức xử phạt 1: Khóa tài khoản 7 ngày<br>
                        + Hình thức xử phạt 2: Khóa tài khoản 15 ngày<br>
                        + Hình thức xử phạt 3: Khóa tài khoản 30 ngày hoặc khóa tài khoản vĩnh viễn. <br>
                        2.   Các hình thức xử phạt.<br>
                        •	Hình thức xử phạt 3, khóa tài khoản 30 ngày hoặc khóa vĩnh viễn được áp dụng  đối với các hành vi sau:<br>
                        Người Sử Dụng có hành vi lợi dụng Chiasenhac.vn nhằm chống phá nước Cộng Hòa Xã Hội Chủ Nghĩa Việt Nam; gây phương hại đến an ninh quốc gia, trật tự, an toàn xã hội; phá hoại khối đại đoàn kết toàn dân; tuyên truyền chiến tranh xâm lược, khủng bố; gây hận thù, mâu thuẫn giữa các dân tộc, sắc tộc, chủng tộc, tôn giáo; Tuyên truyền, kích động bạo lực, dâm ô, đồi trụy, tội ác, tệ nạn xã hội, mê tín dị đoan, phá hoại thuần phong, mỹ tục của dân tộc; bàn luận, đăng tải các nội dung về các vấn đề chính trị.<br>
                        -	Thông tin, hình ảnh, video khiêu dâm: Người Sử Dụng đăng tải hình ảnh, âm thanh, video khiêu dâm, chat sex hoặc đăng tải thông tin về địa chỉ phòng chát sex trực tiếp, video khiêu dâm, tuyên truyền các có nội dung khiêu dâm.<br>
                        -	Thông tin cá cược, cờ bạc: Lợi dụng Chiasenhac.vn, người dùng đăng tải nội dung thông tin, hình ảnh, âm thanh, video chứa thông tin để tổ chức các hình thức cá cược, cờ bạc hoặc các thỏa thuận liên quan đến tiền, hiện kim, hiện vật.<br>
                        -	Lan truyền thông tin lừa đảo: Sử dụng văn bản, hình ảnh, âm thanh hoặc video có chứa thông tin lừa đảo: giả làm chính thức hoặc các tổ chức, cá nhân; gian lận, lừa đảo tài sản của người khác.<br>
                        -	Phá hoại hệ thống mạng xã hội Chiasenhac.vn: Thành viên lợi dụng việc sử dụng sản phẩm để xâm nhập vào hệ thống máy chủ nhằm phá hoại sản phẩm hoặc cản trở việc truy cập thông tin. Thành viên sử dụng công cụ kỹ thuật nhằm tăng điểm hoạt động, vật phẩm hoặc nhằm treo máy, spam chat.<br>
                        -	Sử dụng phòng cộng đồng để lôi kéo tổ chức hội họp thực tế ở bên ngoài thực hiện các hành vi vi phạm pháp luật.<br>
                        •	Hình thức xử phạt 2, khóa tài khoản 15 đối với các hành vi sau.<br>
                        -	Hành vi giao tiếp: Chát khiêu dâm ở mức độ nhẹ, spam chat, kích động các thành viên khác đến các kênh khác của Chiasenhac.vn để gây rối hoặc tuyên truyền những thông tin vi phạm.<br>
                        -	Xâm phạm riêng tư: Sử dụng hình ảnh cá nhân của người khác, công khai những tư liệu cá nhân và những thông tin của khác như danh tính, địa chỉ, số điện thoại mà chưa được sự đồng ý và tiến hành gọi điện quấy nhiễu hoặc khích động người khác quấy nhiễu.<br>
                        -	Công kích người khác: Sử dụng hình ảnh, thông tin, âm thanh hoặc video, xúc phạm, đưa thông tin xuyên tạc, vu khống, nhạo bang, xúc phạm uy tín tới tổ chức, cá nhân.<br>
                        -	Vi phạm bản quyền: Ăn cắp các nội dung trên các kênh, sao chép hoặc trích dẫn mà không được phép sử dụng bản quyền của người khác.<br>
                        •	Hình thức xử phạt 1, khóa tài khoản 7 ngày theo khoản 1 điều này được áp dụng đối với các hành vi sau.<br>
                        a.	Công kích, xuyên tạc, xúc phạm nhân phẩm các thành viên khác.<br>
                        b.	Lôi kéo công đồng thành viên tham gia Phòng cộng đồng có chủ đích bằng các câu view sai phạm, vi phạm văn hóa đạo đức.<br>
                        <br>
                        V. Nội dung cung cấp, trao đổi thông tin.<br>
                        2.  Nội dung đăng tải ở các kênh phải tương thích, phù hợp với chủ đề mà Chiasenhac.vn định hướng bao gồm thông tin về âm nhạc<br>
                        3.  Chiasenhac.vn không chứng thực bất kỳ nội dung nào được đăng tải, sử dụng trên phần mềm bởi bất kỳ Người Sử Dụng nào. Chiasenhac.vn không cho phép các hoạt động vi phạm bản quyền và xâm phạm quyền sở hữu trí tuệ trên dịch vụ, và Chiasenhac.vn sẽ loại bỏ tất cả các nội dung phát hành nếu được thông báo rằng những nội dung vi phạm quyền sở hữu trí tuệ mà không cần thông báo trước.<br>
                        4.  Hệ thống Chiasenhac.vn cho phép Người Sử Dụng đăng tải, cung cấp, trao đổi các thông tin, hình ảnh hoặc các nội dung khác lên trên website trừ những nội dung cấm được quy định trong bản Quy chế này và các văn bản pháp luật liên quan.<br>
                        5.  Người Sử Dụng là người phát triển, thực hiện được quyền trò chuyện, chia sẻ kinh nghiệm, giao lưu trực tuyến, và/hoặc những nội dung video khác phù hợp với các quy định của Chiasenhac.vn. Bạn đồng ý rằng bạn sẽ không đăng tải lên Chiasenhac.vn các nội dung đã có bản quyền, các bí mật thương mại hoặc các nội dung khác liên quan tới các quyền sở hữu trí tuệ của bên thứ ba, trừ trường hợp bạn là chủ sở hữu hợp pháp của các nội dung này hoặc có sự chấp thuận từ chủ sở hữu.<br>
                        6.  Người Sử Dụng có thể sẽ chịu trách nhiệm bồi thường thiệt hại dân sự, khả năng bị phạt vi phạm hành chính hoặc bị truy tố trách nhiệm hình sự nếu có hành vi vi phạm quyền tác giả hoặc quyền liên quan.<br>
                        7.  Bạn đồng ý để chúng tôi tự do kinh doanh, sử dụng, phát tán, trình chiếu, chỉnh sửa, biên soạn bất kỳ ý tưởng, khái niệm, cách thức, đề xuất, gợi ý, bình luận hoặc hình thức khác của bạn mà bạn cung cấp, trao đổi, chia sẻ thông qua việc sử dụng hệ thống website Chiasenhac.vn một cách hoàn toàn miễn phí. Bạn đồng ý từ bỏ bất kỳ quyền và yêu cầu với bất kỳ khoản tiền thưởng, phí, nhuận bút, lệ phí hoặc các chi trả khác liên quan đến việc chúng tôi kinh doanh, sử dụng, phát tán, trình chiếu, chỉnh sửa, biên soạn bất kỳ hoặc tất cả những thông tin, hình ảnh mà bạn cung cấp, chia sẻ, trao đổi của bạn.<br>
                        8.  Bạn cũng cho phép Người Sử Dụng được quyền sử dụng lại thông tin đăng tải của bạn bao gồm nhưng không giới hạn việc chỉnh sửa lại, biên soạn, phân tán, trình chiếu nội dung đăng tải đó vì mục đích cá nhân hoặc phi thương mại.<br>
                        9.  Tại các khu vực được phép truyền phát hình ảnh, đăng tải bài viết, bạn có thể chia sẻ thông tin, hình ảnh được phép dưới các định dạng chúng tôi mặc định. Bạn đồng ý cam kết thực hiện trách nhiệm đảm bảo sử dụng hợp pháp nội dung thông tin số đưa lên đăng tải trên hệ thống mạng internet và mạng viễn thông.<br>
                        10. Trong mọi trường hợp, Chiasenhac.vn được quyền xử lý các thông tin đăng tải cho phù hợp với thuần phong mỹ tục, các quy tắc đạo đức và các quy tắc đảm bảo an ninh quốc gia, và chúng tôi có toàn quyền cho phép hoặc không cho phép bài viết, thông tin, hình ảnh của bạn xuất hiện hay tồn tại trên hệ thống website Chiasenhac.vn.<br>
                        11. Người Sử Dụng hiểu và đồng ý rằng, khi sử dụng website và phần mềm mạng xã hội này, Người Sử Dụng sẽ tiếp nhận nhiều nội dung thông tin, hình ảnh được đăng tải từ nhiều nguồn khác nhau. Chiasenhac.vn không chịu trách nhiệm về mức độ chính xác, tính hữu ích, độ an toàn, hoặc các quyền sở hữu trí tuệ liên quan tới những thông tin mà Người Sử Dụng khác đăng tải. Khi sử dụng sản phẩm có thể bạn thấy một vài thông tin, bình luận do Người Sử Dụng đăng tải không đúng sự thật, hoặc gây phản cảm, trong trường hợp này, bạn có thể liên hệ với chúng tôi để tiến hành các biện pháp cần thiết để đảm bảo quyền lợi cho người sử dụng.<br>
                        12. Chiasenhac.vn quan tâm tới sự an toàn và riêng tư, quyền lợi của tất cả thành viên sử dụng sản phẩm của mình, đặc biệt là trẻ em. Vì vậy, nếu bạn là cha mẹ hoặc người giám hộ hợp pháp của Người Sử Dụng, bạn có trách nhiệm xem xét và xác định sản phẩm, nội dung nào của Chiasenhac.vn thích hợp cho con em của mình. Tương tự, nếu Người Sử Dụng là trẻ em thì bạn phải hỏi ý kiến cha mẹ hoặc người giám hộ hợp pháp của mình về việc sản phẩm, nội dung mình sử dụng có phù hợp hay không.<br>
                        13. Khi Người Sử Dụng truy cập vào sản phẩm khác, ứng dụng hoặc website liên kết với mạng xã hội này, Người Sử Dụng phải hiểu và tuân thủ những quy định về sản phẩm mà Người Sử Dụng sử dụng. Có thể có những sản phẩm không thuộc quyền sở hữu của Chiasenhac.vn, và do vậy Người Sử Dụng phải tự chịu trách nhiệm những rủi ro phát sinh khi sử dụng sản phẩm này.<br>
                        14. Nhằm đảm bảo sự hài lòng của khách hàng, Chiasenhac.vn luôn sáng tạo, nâng cấp sản phẩm được tốt hơn, vì vậy, sản phẩm mạng xã hội này có thể được phát triển trên thiết bị viễn thông hoặc công nghệ khác (nếu có), và do vậy có thể những thông tin liên quan cá nhân sẽ được hiển thị bao gồm nhưng không giới hạn như địa điểm nơi bạn đang sử dụng dịch vụ, sản phẩm.<br>
                        15. Mạng xã hội này có nhiều tính năng, chức năng, tích hợp nhiều trò chơi, ứng dụng, liên kết website vì vậy khi sử dụng sản phẩm này, Người Sử Dụng cần phải đọc kỹ các hướng dẫn, quy định sử dụng sản phẩm.<br>
                        <br>
                        VI. Quyền và nghĩa vụ của người sử dụng<br>
                        6.1 Quyền của người sử dụng:<br>
                        Khi tham gia mạng xã hội Chiasenhac.vn người sử dụng sẽ được đảm bảo các quyền lợi sau:<br>
                        a.	Quyền được tự do tạo lập tài khoản tại Chiasenhac.vn để chia sẻ trao đổi thông tin về cá nhân, tổ chức/, cũng như đăng tải những thông tin liên âm nhạc lên mạng xã hội Chiasenhac.vn để cùng nhau trao đổi, bình luận.<br>
                        b.	Quyền được Chiasenhac.vn bảo mật thông tin tài khoản.<br>
                        c.	Quyền được tự do khai thác thông tin, tự do trao đổi, bình luận miễn phí về các nội dung mạng xã hội Chiasenhac.vn cung cấp trong phạm vi nội dung quy định tại thỏa thuận sử dụng mạng xã hội.<br>
                        d.	Quyền được yêu cầu ban quản trị tiến hành các biện pháp xác mình thông tin để giải quyết các tranh chấp trong quá trình khai thác và sử dụng các thông tin, tiện ích tại Chiasenhac.vn.<br>
                        e.	Quyền được thông báo khi ban quản trị Chiasenhac.vn cung cấp thông tin khi có yêu cầu của cơ quan nhà nước.<br>
                        6.2 Nghĩa vụ của người sử dụng<br>
                        a.	Tuân thủ quy chế quản lý, cung cấp và sử dụng dịch vụ mạng xã hội.<br>
                        b.	Chịu trách nhiệm về nội dung thông tin do mình lưu trữ, cung cấp, truyền đưa trên mạng xã hội, phát tán thông tin qua đường liên kết trực tiếp do mình thiết lập.<br>
                        c.	Người Sử Dụng có trách nhiệm bảo mật thông tin tài khoản, nếu những thông tin trên bị tiết lộ dưới bất kỳ hình thức nào thì Người Sử Dụng phải chấp nhận những rủi ro phát sinh. Chiasenhac.vn sẽ căn cứ vào những thông tin hiện có trong tài khoản để làm căn cứ quyết định chủ sở hữu tài khoản nếu có tranh chấp và chúng tôi sẽ không chịu trách nhiệm về mọi tổn thất phát sinh.<br>
                        d.	Người Sử Dụng đồng ý sẽ thông báo ngay cho Chiasenhac.vn về bất kỳ trường hợp nào sử dụng trái phép tài khoản và mật khẩu của bạn hoặc bất kỳ các hành động phá vỡ hệ thống bảo mật nào. Bạn cũng bảo đảm rằng, bạn luôn thoát tài khoản của mình sau mỗi lần sử dụng.<br>
                        e.	Khi phát hiện ra lỗi của Chiasenhac.vn, bạn hãy thông báo cho chúng tôi qua hai hệ thống sau:<br>
                        - Email liên hệ: admin@chiasenhac.vn<br>
                        -  Hỗ trợ qua đường dây nóng: (08)- 38511017<br>
                        f.	 Người Sử Dụng có thể sẽ bị xử phạt vi phạm hành chính, bị truy tố trách nhiệm hình sự nếu bạn vi phạm về quyền tác giả, quyền liên quan khi bạn sử dụng sản phẩm mạng xã hội Chiasenhac.vn này.<br>
                        g.	Người Sử Dụng phải tuân thủ tuyệt đối quy định về các hành vi cấm, các nội dung trao đổi cung cấp thông tin được quy định trong quy chế này. Nếu vi phạm một hoặc nhiều hành vi, tùy thuộc vào mức độ vi phạm Chiasenhac.vn sẽ tiến hành khóa tài khoản vĩnh viễn và có thể sẽ yêu cầu cơ quan chức năng truy tố bạn trước pháp luật nếu cần thiết.<br>
                        h.	Thực hiện quyền và trách nhiệm khác theo quy định pháp luật<br>
                        <br>
                        VII. Quyền và trách nhiệm của Chiasenhac.vn <br>
                        7.1 Quyền <br>
                        a. Cung cấp dịch vụ mạng xã hội cho công cộng trừ các dịch vụ bị cấm theo quy định của <br>
                        b.  Trong quá trình sử dụng sản phẩm, nếu bạn vi phạm bất cứ điều khoản nào trong Thỏa thuận cung cấp dịch vụ mạng xã hội này, chúng tôi có toàn quyền chấm dứt, xóa bỏ tài khoản của bạn mà không cần sự đồng ý của bạn và không phải chịu bất cứ trách nhiệm nào đối với bạn.<br>
                        c.  Mọi vi phạm của chủ tài khoản trong quá trình sử dụng sản phẩm Chiasenhac.vn, chúng tôi có quyền tước bỏ mọi quyền lợi của chủ tài khoản đối với việc sử dụng sản phẩm cũng như sẽ yêu cầu cơ quan chức năng truy tố bạn trước pháp luật nếu cần thiết.<br>
                        d.  Khi phát hiện những vi phạm như sử dụng hacks, truyền bá nội dung cấm hoặc những lỗi khác, Chiasenhac.vn có quyền sử dụng những thông tin mà bạn cung cấp khi đăng ký tài khoản để chuyển cho Cơ quan chức năng giải quyết theo quy định của pháp luật.<br>
                        e.  Khi phát hiện những vi phạm về nội dung cấm được quy định tại Thỏa thuận này, Chiasenhac.vn có quyền tắt ngay lập tức các video đang được phát sóng bởi Người Sử Dụng và/hoặc cảnh cáo, khóa, tạm dừng chat của Người Sử Dụng vi phạm. Trong trường hợp nhận được tố cáo của Người Sử Dụng khác, Chiasenhac.vn sẽ tiến hành giám sát kiểm tra và log data cùng những chứng cứ liên quan, nếu phát hiện vi phạm Chiasenhac.vn có quyền tắt ngay lập tức các video đang được phát sóng bởi Người Sử Dụng và/hoặc cảnh cáo, khóa, tạm dừng chat của Người Sử Dụng vi phạm. Chúng tôi có toàn quyền quyết định các hình thức xử lý đối với các trường hợp vi phạm. Tuy vào tính chất sự việc, mức độ ảnh hưởng và nghiêm trọng, chúng tôi sẽ đưa ra hình thức xử lý phù hợp. Quyết định của Chiasenhac.vn là quyết định cuối cùng và người dùng đồng ý chấp hành.    <br>
                        7.2 Trách nhiệm của Chiasenhac.vn<br>
                        a.	Công khai thỏa thuận cung cấp và sự dụng mạng xã hội<br>
                        b.	Có trách nhiệm hỗ trợ chủ tài khoản trong quá trình sử dụng sản phẩm của Chiasenhac.vn.<br>
                        c.	Có trách nhiệm bảo đảm bí mật thông tin riêng, thông tin cá nhân của người sử dụng, thông báo cho người sử dụng về quyền, trách nhiệm và các rủi ro khi lưu trữ, trao đổi và chia sê thông tin trên mạng.<br>
                        d.	Bảo đảm quyền quyết định của người sử dụng khi cho phép thông tin cá nhân của mình được cung cấp cho tổ chức, doanh nghiệp, cá nhân khác.<br>
                        e.	Không được chủ động cung cấp thông tin công cộng có nội dung vi phạm tại điều 5 nghị định 72/2013 NĐ-CP về Quản lý, cung cấp, sử dụng dịch vụ internet và thông tin trên mạng. <br>
                        f.	Phối hợp với cơ quan nhà nước có thẩm quyền để loại bỏ ngăn chặn thông tin có nội dung vi phạm quy định tại điều 5 nghị định 72/2013 NĐ-CP về Quản lý, cung cấp, sử dụng dịch vụ internet và thông tin trên mạng khi có yêu cầu.<br>
                        g.	Có ít nhất 01 hệ thống máy chủ đặt tại Việt Nam đáp ứng việc thanh tra, kiểm tra, lưu trữ, cung cấp thông tin theo yêu cầu của cơ quan quản lý nhà nước có thẩm quyền và giải quyết khiếu nại của khách hàng đối với việc cung cấp dịch vụ theo quy định của Bộ Thông tin và Truyền thông<br>
                        h.	Thực hiện việc đăng ký, lưu trữ và quản lý thông tin cá nhân của người thiết lập trang thông tin điện tử cá nhân và người cung cấp thông tin khác trên mạng xã hội theo quy định của Bộ Thông tin và Truyền thông. Bảo đảm chỉ những người đã cung cấp đầy đủ, chính xác thông tin cá nhân theo quy định mới được thiết lập trang thông tin điện tử cá nhân hoặc cung cấp thông tin trên mạng xã hội<br>
                        i.	 Báo cáo theo quy định và chịu sự thanh tra, kiểm tra của các cơ quan quản lý nhà nước có thẩm quyền<br>
                        j.	  Nhận và giải quyết khiếu nại của khách hàng các trường hợp phát sinh trong quá trình sử dụng Chiasenhac.vn, tuy nhiên chúng tôi chỉ hỗ trợ, nhận và giải quyết đối với tài khoản đăng ký đầy đủ thông tin, trung thực và chính xác.<br>
                        <br>
                        VIII. Giới hạn trách nhiệm và từ chối đảm bảo.<br>
                        1.  Chiasenhac.vn sẽ không chịu trách nhiệm đối với bất cứ vấn đề gì về hệ thống trong quá trình bạn sử dụng sản phẩm Chiasenhac.vn.<br>
                        2.  Nếu phát sinh rủi ro, thiệt hại trong trường hợp bất khả kháng bao gồm nhưng không giới hạn như chập điện, hư hỏng phần cứng, phần mềm, sự cố đường truyền internet hoặc do thiên tai ... người dùng phải chấp nhận những rủi ro, thiệt hại nếu có. Chúng tôi cam kết sẽ nỗ lực giảm thiểu những rủi ro, thiệt hại phát sinh tuy nhiên Chiasenhac.vn sẽ không chịu bất cứ trách nhiệm nào phát sinh trong các trường hợp này.<br>
                        3.  Chiasenhac.vn hoàn toàn không chịu trách nhiệm rủi ro về mọi giao dịch của bạn với bên thứ 3 trong quá trình sử dụng sản phẩm Chiasenhac.vn. Khi bạn sử dụng sản phẩm và/hoặc giao dịch với bên thứ 3, bạn đã hiểu và đồng ý tự chịu trách nhiệm những rủi ro phát sinh.<br>
                        4.  Bài viết, clip, video của Người Sử Dụng có thể có những hạn chế, có thể gây phản đối, bất hợp pháp, không chính xác, hoặc không phù hợp. Chiasenhac.vn không có trách nhiệm cho bất kỳ bài viết nào, clip, video, hình ảnh nào. Nội dung được đăng không phản ánh quan điểm hay chính sách của Chiasenhac.vn. Chúng tôi có quyền, nhưng không có nghĩa vụ, giám sát và hạn chế hoặc loại bỏ các nội dung đăng tải trên trừ khi chúng tôi có cơ sở cho rằng, nội dung được đăng tải là vi phạm thỏa thuận này cũng như vi phạm pháp luật.<br>
                        <br>
                        IX.  Bản quyền và quy trình báo cáo vi phạm bản quyền<br>
                        1.  Tại các khu vực được phép đăng tải nội dung, bạn có thể chia sẻ thông tin được phép dưới các định dạng chúng tôi mặc định và bạn phải tự chịu trách nhiệm đối với các nội dung, thông tin, hình ảnh và bất kỳ sự chia sẻ nào khác cũng như tính hợp pháp, các trách nhiệm pháp lý đối với nội dung, thông tin, chia sẻ của bạn với cá nhân người sử dụng hoặc nhóm Người Sử Dụng, tổ chức sử dụng. Tuy nhiên, trong mọi trường hợp, chúng tôi vẫn được bảo lưu quyền xử lý các thông tin đăng tải cho phù hợp với thuần phong mỹ tục, các quy tắc đạo đức và các quy tắc đảm bảo an ninh quốc gia, và chúng tôi có toàn quyền cho phép hoặc không cho phép bài viết của bạn xuất hiện hay tồn tại trên diễn đàn hoặc tại các khu vực được phép chia sẻ thông tin.<br>
                        2.  Chúng tôi có toàn quyền, bao gồm nhưng không giới hạn trong các quyền tác giả, thương hiệu, bí mật kinh doanh, nhãn hiệu và các quyền sở hữu trí tuệ khác trong sản phẩm của Chiasenhac.vn. Việc sử dụng quyền và sở hữu của chúng tôi cần phải được chúng tôi cho phép trước bằng văn bản. Ngoài việc được cấp phép bằng văn bản, chúng tôi không cấp phép dưới bất kỳ hình thức nào khác cho dù đó là hình thức công bố hay hàm ý để bạn thực hiện các quyền trên. Và do vậy, Người Sử Dụng không có quyền sử dụng sản phẩm của chúng tôi vào mục đích thương mại mà không có sự cho phép bằng văn bản của chúng tôi trước đó.<br>
                        3.  Người Sử Dụng đồng ý để chúng tôi tự do sử dụng, tiết lộ, áp dụng và sửa đổi bất kỳ ý tưởng, khái niệm, cách thức, đề xuất, gợi ý, bình luận hoặc hình thức thông báo nào khác mà Người Sử Dụng cung cấp cho chúng tôi thông qua việc sử dụng sản phẩm Chiasenhac.vn một cách hoàn toàn miễn phí. Bạn từ bỏ và đồng ý từ bỏ bất kỳ quyền và yêu cầu với bất kỳ khoản tiền thưởng, phí, nhuận bút, lệ phí hoặc các kiểu chi trả khác liên quan đến việc chúng tôi sử dụng, tiết lộ, áp dụng, chỉnh sửa bất kỳ hoặc tất cả phản hồi của bạn.<br>
                        4.  Quy trình báo cáo vi phạm bản quyền:<br>
                        -	Nếu Người Sử Dụng tin rằng bất kỳ nội dung, tài liệu, hình ảnh, video hoặc các tài liệu khác của mình được cung cấp thông qua Dịch vụ Chiasenhac.vn đang bị vi phạm quyền sở hữu trí tuệ, vui lòng thông báo cho chúng tôi về việc vi phạm bản quyền theo quy trình cụ thể được quy định dưới đây.<br>
                        -	Chúng tôi sẽ xử lý từng thông báo vi phạm bản quyền mà chúng tôi nhận được và xử lý theo quy định của pháp luật sở hữu trí tuệ.<br>
                        -	Để giúp chúng tôi có đủ cơ sở đáp ứng các yêu cầu của bạn, vui lòng gửi thông báo bằng văn bản với các thông tin sau:<br>
                        +  Chữ ký thật của người người được ủy quyền thay mặt cho chủ sở hữu của một sản phẩm độc quyền.<br>
                        +  Mô tả tác phẩm có bản quyền mà bạn cho là bị vi phạm,<br>
                        +  Mô tả về nơi mà các tài liệu bạn cho là vi phạm nằm trên các Dịch vụ Chiasenhac.vn đủ để cho phép chúng tôi xác định vị trí tài liệu đó.<br>
                        +  Thông tin liên hệ của bạn như địa chỉ, số điện thoại, email để Chiasenhac.vn có thể liên hệ với bạn.<br>
                        +  Bạn tuyên bố rằng bạn tin tưởng việc sử dụng nội dung đó là không được phép của chủ sở hữu quyền tác giả, đại lý độc quyền hoặc pháp luật;<br>
                        +  Bạn tuyên bố rằng các thông tin trong thông báo của bạn là chính xác và bạn chấp nhận hình phạt về tội khai man mà bạn được ủy quyền hành động thay mặt cho chủ sở hữu bản quyền.<br>
                        +  Nếu tài khoản người sử dụng Chiasenhac.vn vi phạm về sở hữu trí tuệ thông qua việc Người Sử Dụng gửi thông báo, nếu kết quả cho thấy Tài khoản có sự vi phạm thì tùy vào mức độ nghiêm trọng của sự việc, Chiasenhac.vn có toàn quyền quyết định xóa tài khoản vi phạm đó.<br>
                        -	Email liên hệ:  admin@chiasenhac.vn<br>
                        - 	Hỗ trợ qua đường dây nóng: (08) 38511017<br>
                        <br>
                        X. Những rủi ro khi lưu trữ, trao đổi và chia sẻ thông tin trên internet<br>
                        -	Khi chia sẻ thông tin trên các diễn đàn, mạng xã hội, bạn thường cập nhật thông tin trong phần tiểu sử, ảnh, cập nhật trạng thái (những tin bạn chia sẻ với những người trong danh sách bạn bè) và bình luận (những hồi đáp của bạn về phần cập nhật trạng thái của người khác). Những thông tin này có chiều hướng tăng dần và thường xuyên được cập nhật liên tục. Chẳng hạn, bạn có thể để lộ địa chỉ nơi mình sống, thời gian bạn thường có mặt (và vắng mặt) ở nhà, nơi làm việc hoặc trường của bạn. Việc chia sẻ này vô tình tạo điều kiện cho những kẻ có mưu đồ bất chính có thông tin để lên kế hoạch thực hiện một vụ án. (trộm cắp, giết người, hiếp dâm …)<br>
                        -	Nhiều người sử dụng internet dễ dàng để lộ thông tin trong trang cá nhân của mình. Các thông tin có thể bị bộc lộ như địa chỉ hòm thư điện tử, ngày tháng năm sinh hay số điện thoại có thể khiến bạn bị quấy rối, xâm phạm và mạo danh trên mạng. <br>
                        -	Nhiều người không lường trước được rằng một khi thông tin được chia sẻ trao đổi trên mạng, nó trở thành thông tin công cộng. Ngay cả khi chỉ chia sẻ cập nhật trạng thái với một người hoặc một nhóm người thì người sử dụng cũng không thế kiểm soát được những người này sẽ làm gì với những thông tin ấy. Mặt khác, bất kỳ thông tin nào được chia sẻ trên mạng cũng có thể được xem là thông tin công cộng và từ chỗ là thông tin riêng tư sẽ bị chia sẻ và phổ biến rộng rãi.<br>
                        -	Trong phạm vi của mình, Công ty sẽ bảo đảm tối đa thông tin cá nhân thành viên, tuy nhiên trong môi trường Internet dễ bị tấn công và xâm phạm là khó tránh khỏi.<br>
                        <br>
                        XI. Cơ chế giải quyết khiếu nại, tranh chấp <br>
                        Thời hạn giải quyết khi có khiếu nại, tranh chấp phát sinh là 2 tuần, theo quy trình cụ thể sau:<br>
                        Bước 1: Khi có tranh chấp xảy ra (từ 3 đến 5 ngày): <br>
                        -	Đối với người gửi khiếu nại tranh chấp cần có trách nhiệm cung cấp các chứng cứ thông tin xác thực liên quan đến sự việc đang gây mâu thuẫn. <br>
                        -	Đối với Chiasenhac.vn sẽ có trách nhiệm kiểm tra các chứng cứ, thông tin mà bên khiếu nại đưa ra và có phản hồi thông qua hệ thống đã nhận khiếu nại.<br>
                        Bước 2: Giải quyết tranh chấp (từ 4 tới 6 ngày):<br>
                        -	Trong trường hợp tranh chấp phát sinh đã được chứng minh từ lỗi của một thành viên xác định Chiasenhac.vn sẽ có biện pháp cảnh cáo, khóa tài khoản hoặc chuyển cho cơ quan pháp luật có thẩm quyền tùy theo mức độ của sai phạm. Chiasenhac.vn sẽ chấm dứt và gỡ bỏ toàn bộ bài viết, bình luận của thành viên đó trên Chiasenhac.vn đồng thời yêu cầu thành viên đó phải công khai xin lỗi bên đã bị xâm phạm. <br>
                        -	Nếu thông qua hình thức thỏa thuận mà vẫn không thể giải quyết được tranh chấp, mâu thuẫn phát sinh từ trao đổi giữa các bên, thì một trong 2 bên sẽ có quyền nhờ đến cơ quan pháp luật có thẩm quyền can thiệp nhằm đảm bảo lợi ích hợp pháp của các bên. <br>
                        Bước 3: Nghĩa vụ thông báo (2 ngày):<br>
                        Sau khi các bên đã giải quyết xong tranh chấp phải có trách nhiệm báo lại cho Ban quản trị Chiasenhac.vn.<br>
                        Chiasenhac.vn có trách nhiệm tiếp nhận khiếu nại và hỗ trợ các thành viên của mạng xã hội giải quyết các tranh chấp trong phạm vi của mạng xã hội.<br>
                        Những thành viên là các nhân tổ chức có thể gửi khiếu nại về hai kênh hỗ trợ sau:<br>
                        - Email: admin@chiasenhac.vn<br>
                        - Hotline: (08) 3851.1017<br>
                        Chiasenhac.vn tôn trọng và nghiêm túc thực hiện các quy định của pháp luật về giải quyết các tranh chấp, khiếu nại của các thành viên tham gia mạng xã hội. Vì vậy, đề nghị các thành viên đăng ký hoặc viết bình luận tôn trọng lẫn nhau đồng thời cung cấp đầy đủ, chính xác, trung thực và chi tiết các thông tin liên quan đến nhân thân. Mọi hành vi lừa đảo, gian lận trong thông tin đều bị lên án và phải chịu hoàn toàn trách nhiệm trước pháp luật. <br>
                        <br>
                        XII. Thu thập thông tin các nhân và chính sách bảo vệ thông tin các nhân, thông tin riêng của người sử dụng dịch vụ mạng xã hội. <br>
                        1.	Phạm vi thu thập thông tin<br>
                        Việc thu thập dữ liệu chủ yếu trên Mạng xã hội Chiasenhac.vn bao gồm: email, điện thoại, tên đăng nhập, mật khẩu đăng nhập, địa chỉ thành viên. Đây là các thông tin mà Chiasenhac.vn cần thành viên cung cấp bắt buộc khi đăng ký sử dụng dịch vụ và để Chiasenhac.vn liên hệ xác nhận khi thành viên đăng ký sử dụng dịch vụ trên website nhằm đảm bảo quyền lợi cho cho chính các thành viên. <br>
                        Các thành viên sẽ tự chịu trách nhiệm về bảo mật và lưu giữ mọi hoạt động sử dụng dịch vụ dưới tên đăng ký, mật khẩu và hộp thư điện tử của mình. Ngoài ra, thành viên có trách nhiệm thông báo kịp thời cho Mạng xã hội Chiasenhac.vn về những hành vi sử dụng trái phép, lạm dụng, vi phạm bảo mật, lưu giữ tên đăng ký và mật khẩu của bên thứ ba để có biện pháp giải quyết phù hợp. <br>
                        Khi tiến hành thu thập thông tin sẽ phải thông báo với : <br>
                        	Người sử dụng, tham gia vào mạng xã hội :<br>
                        •	Trường hợp người sử dụng đồng ý cung cấp thông tin: có thể tạo lập tài khoản cá nhân để tham gia vào sử dụng các tiện ích của mạng xã hội trong phạm vi theo thỏa thuận đã đồng ý khi tiến hành tạo lập tài khoản.<br>
                        •	Trường hợp người sử dụng không đồng ý: không phát sinh quyền và nghĩa vụ đối với trang mạng xã hội.<br>
                        2. Mục đích sử dụng thông tin <br>
                        Mạng xã hội Chiasenhac.vn sử dụng thông tin thành viên cung cấp để: <br>
                        -  Cung cấp các dịch vụ đến Thành viên; <br>
                        -  Gửi các thông báo về các hoạt động trao đổi thông tin giữa thành viên và Mạng xã hội Chiasenhac.vn; <br>
                        -  Ngừa các hoạt động phá hủy tài khoản người dùng của thành viên hoặc các hoạt động giả mạo Thành viên; <br>
                        -  Liên lạc và giải quyết với thành viên trong những trường hợp đặc biệt. <br>
                        -   Không sử dụng thông tin cá nhân của thành viên ngoài mục đích xác nhận và liên hệ có liên quan đến hoạt động tại Chiasenhac.vn. <br>
                        -   Trong trường hợp có yêu cầu của pháp luật: Mạng xã hội Chiasenhac.vn có trách nhiệm hợp tác cung cấp thông tin cá nhân thành viên khi có yêu cầu từ cơ quan tư pháp bao gồm: Viện kiểm sát, tòa án, cơ quan công an điều tra liên quan đến hành vi vi phạm pháp luật nào đó của khách hàng. Ngoài ra, không ai có quyền xâm phạm vào thông tin cá nhân của thành viên<br>
                        3. Thời gian lưu trữ thông tin <br>
                        Dữ liệu cá nhân của Thành viên sẽ được lưu trữ cho đến khi có yêu cầu hủy bỏ hoặc tự thành viên đăng nhập và thực hiện hủy bỏ. Còn lại trong mọi trường hợp thông tin cá nhân thành viên sẽ được bảo mật trên máy chủ của Chiasenhac.vn<br>
                        4. Địa chỉ của đơn vị thu thập và quản lý thông tin cá nhân <br>
                        Công ty Cổ Phần GIẢI TRÍ YÊU CA HÁT<br>
                        Trụ sở chính: số 181/75 Âu Dương Lân, Phường 2, Quận 8, TP HCM, thành phố Hồ Chí Minh.<br>
                        5. Phương tiện và công cụ để người dùng tiếp cận và chỉnh sửa dữ liệu cá nhân của mình. <br>
                        - Thành viên có quyền tự kiểm tra, cập nhật, điều chỉnh hoặc hủy bỏ thông tin cá nhân của mình bằng cách đăng nhập vào tài khoản và chỉnh sửa thông tin cá nhân hoặc yêu cầu Chiasenhac.vn thực hiện việc này. <br>
                        - Thành viên có quyền gửi khiếu nại về việc lộ thông tin các nhân cho bên thứ 3 đến Ban quản trị của Mạng xã hội Chiasenhac.vn. Khi tiếp nhận những phản hồi này, Chiasenhac.vn sẽ xác nhận lại thông tin, phải có trách nhiệm trả lời lý do và hướng dẫn thành viên khôi phục và bảo mật lại thông tin. <br>
                        -	Email liên hệ:  admin@chiasenhac.vn<br>
                        -	Hỗ trợ qua đường dây nóng (08) 3851.1017<br>
                        6. Chính sách bảo mật thông tin cá nhân thành viên <br>
                        - Thông tin cá nhân của thành viên trên Chiasenhac.vn được cam kết bảo mật tuyệt đối theo chính sách bảo vệ thông tin cá nhân của Chiasenhac.vn. Việc thu thập và sử dụng thông tin của mỗi thành viên chỉ được thực hiện khi có sự đồng ý của thành viên đó trừ những trường hợp pháp luật có quy định khác. <br>
                        - Không sử dụng, không chuyển giao, cung cấp hay tiết lộ cho bên thứ 3 nào về thông tin cá nhân của thành viên khi không có sự cho phép đồng ý từ thành viên. <br>
                        - Trong trường hợp máy chủ lưu trữ thông tin bị hacker tấn công dẫn đến mất mát dữ liệu cá nhân thành viên, Chiasenhac.vn sẽ có trách nhiệm thông báo vụ việc cho cơ quan chức năng điều tra xử lý kịp thời và thông báo cho thành viên được biết. <br>
                        - Bảo mật tuyệt đối mọi thông tin giao dịch trực tuyến của Thành viên bao gồm thông tin hóa đơn kế toán chứng từ số hóa tại khu vực dữ liệu trung tâm an toàn cấp 1 của Chiasenhac.vn. <br>
                        - Ban quản lý Chiasenhac.vn yêu cầu các cá nhân khi đăng ký/mua hàng là thành viên, phải cung cấp đầy đủ thông tin cá nhân có liên quan như: Họ và tên, địa chỉ liên lạc, email, số chứng minh nhân dân, điện thoại … và chịu trách nhiệm về tính pháp lý của những thông tin trên. Ban quản trị Chiasenhac.vn không chịu trách nhiệm cũng như không giải quyết mọi khiếu nại có liên quan đến quyền lợi của Thành viên đó nếu xét thấy tất cả thông tin cá nhân của thành viên đó cung cấp khi đăng ký ban đầu là không chính xác. <br>
                        <br>
                        XIII. Hiệu lực của thỏa thuận.<br>
                        1.  Các điều khoản quy định tại Thỏa Thuận này được quy định trên website có thể được cập nhật, chỉnh sửa bất cứ lúc nào mà không cần phải thông báo trước tới Người Sử Dụng. Chiasenhac.vn sẽ công bố rõ trên Website, Blog – Tin tức về những thay đổi, bổ sung đó.<br>
                        2.  Trong trường hợp một hoặc một số điều khoản Thỏa Thuận cung cấp và sử dụng dịch vụ mạng xã hội Chiasenhac.vn này xung đột với các quy định của luật pháp Việt Nam, điều khoản đó sẽ được chỉnh sửa cho phù hợp với quy định pháp luật hiện hành, phần còn lại của Thỏa Thuận vẫn giữ nguyên giá trị.<br>
                        Thỏa Thuận cung cấp và sử dụng dịch vụ mạng xã hội Chiasenhac.vn  có giá trị từ ngày 10 tháng 05  năm 2016.<br>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_banner')
            </div>
        </div>
    </div>
@endsection

