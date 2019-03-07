<?php

namespace HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HomeBundle\Entity\Task;

class HomeController extends Controller
{
    public function homeAction()
    {
        $taskEntity = new Task;
        
        $get_task_properties_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_task_properties_form');
        
        $check_session_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'check_session_form');
        
        $log_in_user_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'log_in_user_form');
        
        $log_out_user_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'log_out_user_form');
        
        $re_log_in_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 're_log_in_form');
        
        $get_stored_field_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_stored_field_form');
        $get_stored_layout_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_stored_layout_form');
        
        $set_this_field_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_this_field_form');
        $set_this_layout_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_this_layout_form');
        
        $delete_stored_field_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'delete_stored_field_form');
        $delete_stored_layout_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'delete_stored_layout_form');
        
        $update_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'update_form');
        $set_usualMode_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_usualMode_form');
        $set_currentMode_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_currentMode_form');
        
        $get_comment_about_video_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_comment_about_video_form');
        $add_comment_video_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'add_comment_video_form');
        
        $set_cacheList_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_cacheList_form');
        $get_cacheList_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_cacheList_form');
        $set_cacheListVideo_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_cacheListVideo_form');
        $get_cacheListVideo_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_cacheListVideo_form');
                
        $set_specificList_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_specificList_form');
        $get_specificList_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_specificList_form');
        $set_specificListVideo_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_specificListVideo_form');
        $get_specificListVideo_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_specificListVideo_form');
        
        $delete_specificList_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'delete_specificList_form');
        $delete_specificListVideo_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'delete_specificListVideo_form');
        $edit_specificListVideo_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'edit_specificListVideo_form');
        $edit_specificList_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'edit_specificList_form');
        $increase_comments_amount_video_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'increase_comments_amount_video_form');
        
        $read_lyrics_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'read_lyrics_form');
        
        $get_closedCaption_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_closedCaption_form');
        
        $set_closedCaption_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_closedCaption_form');
        
        $delete_specific_closedCaption_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'delete_specific_closedCaption_form');

        $upload_video_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'upload_video_form');
        
        $update_video_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'update_video_form');
        
        $upload_keyword_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'upload_keyword_form');
        
        $search_keyword_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'search_keyword_form');
        
        $get_artist_information_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_artist_information_form');
        
        $get_artist_list_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_artist_list_form');
                
        $get_similar_songs_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_similar_songs_form');
                
        $store_current_keywords_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'store_current_keywords_form');
                
        $get_history_songs_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_history_songs_form');
                
        $get_specific_information_video_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_specific_information_video_form');
                
        $get_similar_playlist_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_similar_playlist_form');
        
        $show_similar_playlist_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'show_similar_playlist_form');
        
        
        $get_followers_profile_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_followers_profile_form');
                
        $get_following_profile_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_following_profile_form');
        
        $get_views_profile_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_views_profile_form');
        
        $get_video_list_profile_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_video_list_profile_form');
        
        $update_info_profile_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'update_info_profile_form');

        $edit_video_properties_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'edit_video_properties_form');

        $get_follower_information_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_follower_information_form');

        $sign_up_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'sign_up_form');
        
        $get_city_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_city_form');
        
        $get_country_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_country_form');
        
        $upload_profile_photo_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'upload_profile_photo_form');
        
        $post_payment_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'post_payment_form');
                
        $get_payment_status_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_payment_status_form');

        $checkout_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'checkout_form');
        
        $get_video_keywords_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_video_keywords_form');
        
        $delete_video_keywords_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'delete_video_keywords_form');
        
        $save_video_keywords_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'save_video_keywords_form');
        
        $play_specific_list_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'play_specific_list_form');

        $get_video_lyric_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_video_lyric_form');
        
        $get_lyric_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_lyric_form');
        
        $save_lyricsWord_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'save_lyricsWord_form');
        
        $delete_lyricsWord_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'delete_lyricsWord_form');
        
        $edit_lyricsWord_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'edit_lyricsWord_form');
        
        $get_video_speed_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_video_speed_form');
        
        $set_video_speed_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_video_speed_form');
        
        $get_lyrics_frame_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_lyrics_frame_form');
        
        $increase_amount_views_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'increase_amount_views_form');
        
        $get_keywordUsers_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_keywordUsers_form');
        
        $get_videosPerKeywordUsers_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_videosPerKeywordUsers_form');
        
        $delete_video_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'delete_video_form');
        
        $get_videos_to_delete_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_videos_to_delete_form');
        
        $decline_delete_video_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'decline_delete_video_form');
        
        $get_window_properties_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'get_window_properties_form');
        
        $set_window_theme_color_form_ajax = $this->createCustomForm(
        'HomeBundle\Form\TaskType', $taskEntity, 'POST', 'set_window_theme_color_form');
        
        return $this->render('@Home/home/home.html.twig', array(
            'get_task_properties_form_ajax' => $get_task_properties_form_ajax->createView(),
            'check_session_form_ajax' => $check_session_form_ajax->createView(),
            
            'log_in_user_form_ajax' => $log_in_user_form_ajax->createView(),
            'log_out_user_form_ajax' => $log_out_user_form_ajax->createView(),
            're_log_in_form_ajax' => $re_log_in_form_ajax->createView(),
            
            'get_stored_field_form_ajax' => $get_stored_field_form_ajax->createView(),
            'get_stored_layout_form_ajax' => $get_stored_layout_form_ajax->createView(),
            
            'set_this_field_form_ajax' => $set_this_field_form_ajax->createView(),
            'set_this_layout_form_ajax' => $set_this_layout_form_ajax->createView(),
            
            'delete_stored_field_form_ajax' => $delete_stored_field_form_ajax->createView(),
            'delete_stored_layout_form_ajax' => $delete_stored_layout_form_ajax->createView(),
            'update_form_ajax' => $update_form_ajax->createView(),
            'set_usualMode_form_ajax' => $set_usualMode_form_ajax->createView(),
            'set_currentMode_form_ajax' => $set_currentMode_form_ajax->createView(),
            
            'get_comment_about_video_form_ajax' => $get_comment_about_video_form_ajax->createView(),
            'add_comment_video_form_ajax' => $add_comment_video_form_ajax->createView(),
            
            'set_cacheList_form_ajax' => $set_cacheList_form_ajax->createView(),
            'get_cacheList_form_ajax' => $get_cacheList_form_ajax->createView(),
            'set_cacheListVideo_form_ajax' => $set_cacheListVideo_form_ajax->createView(),
            'get_cacheListVideo_form_ajax' => $get_cacheListVideo_form_ajax->createView(),
            'set_specificList_form_ajax' => $set_specificList_form_ajax->createView(),
            'get_specificList_form_ajax' => $get_specificList_form_ajax->createView(),
            'set_specificListVideo_form_ajax' => $set_specificListVideo_form_ajax->createView(),
            'get_specificListVideo_form_ajax' => $get_specificListVideo_form_ajax->createView(),
            'delete_specificList_form_ajax' => $delete_specificList_form_ajax->createView(),
            'delete_specificListVideo_form_ajax' => $delete_specificListVideo_form_ajax->createView(),
            'edit_specificListVideo_form_ajax' => $edit_specificListVideo_form_ajax->createView(),
            'edit_specificList_form_ajax' => $edit_specificList_form_ajax->createView(),
            'increase_comments_amount_video_form_ajax' => $increase_comments_amount_video_form_ajax->createView(),
            'read_lyrics_form_ajax' => $read_lyrics_form_ajax->createView(),
            'get_closedCaption_form_ajax' => $get_closedCaption_form_ajax->createView(),
            'set_closedCaption_form_ajax' => $set_closedCaption_form_ajax->createView(),
            'delete_specific_closedCaption_form_ajax' => $delete_specific_closedCaption_form_ajax->createView(),
            'upload_video_form_ajax' => $upload_video_form_ajax->createView(),
            'update_video_form_ajax' => $update_video_form_ajax->createView(),
            'upload_keyword_form_ajax' => $upload_keyword_form_ajax->createView(),
            'search_keyword_form_ajax' => $search_keyword_form_ajax->createView(),
            'get_artist_information_form_ajax' => $get_artist_information_form_ajax->createView(),
            'get_artist_list_form_ajax' => $get_artist_list_form_ajax->createView(),
            'get_similar_songs_form_ajax' => $get_similar_songs_form_ajax->createView(),
            'store_current_keywords_form_ajax' => $store_current_keywords_form_ajax->createView(),
            'get_history_songs_form_ajax' => $get_history_songs_form_ajax->createView(),
            'get_specific_information_video_form_ajax' => $get_specific_information_video_form_ajax->createView(),
            'get_similar_playlist_form_ajax' => $get_similar_playlist_form_ajax->createView(),
            'show_similar_playlist_form_ajax' => $show_similar_playlist_form_ajax->createView(),
            'get_followers_profile_form_ajax' => $get_followers_profile_form_ajax->createView(),
            'get_following_profile_form_ajax' => $get_following_profile_form_ajax->createView(),
            'get_views_profile_form_ajax' => $get_views_profile_form_ajax->createView(),
            'get_video_list_profile_form_ajax' => $get_video_list_profile_form_ajax->createView(),
            'update_info_profile_form_ajax' => $update_info_profile_form_ajax->createView(),
            'edit_video_properties_form_ajax' => $edit_video_properties_form_ajax->createView(),
            'get_follower_information_form_ajax' => $get_follower_information_form_ajax->createView(),
            'sign_up_form_ajax' => $sign_up_form_ajax->createView(),
            'get_city_form_ajax' => $get_city_form_ajax->createView(),
            'get_country_form_ajax' => $get_country_form_ajax->createView(),
            'upload_profile_photo_form_ajax' => $upload_profile_photo_form_ajax->createView(),
            'post_payment_form_ajax' => $post_payment_form_ajax->createView(),
            'get_payment_status_form_ajax' => $get_payment_status_form_ajax->createView(),
            'checkout_form_ajax' => $checkout_form_ajax->createView(),
            'get_video_keywords_form_ajax' => $get_video_keywords_form_ajax->createView(),
            'delete_video_keywords_form_ajax' => $delete_video_keywords_form_ajax->createView(),
            'save_video_keywords_form_ajax' => $save_video_keywords_form_ajax->createView(),
            'play_specific_list_form_ajax' => $play_specific_list_form_ajax->createView(),
            'get_video_lyric_form_ajax' => $get_video_lyric_form_ajax->createView(),
            'get_lyric_form_ajax' => $get_lyric_form_ajax->createView(),
            'save_lyricsWord_form_ajax' => $save_lyricsWord_form_ajax->createView(),
            'delete_lyricsWord_form_ajax' => $delete_lyricsWord_form_ajax->createView(),
            'edit_lyricsWord_form_ajax' => $edit_lyricsWord_form_ajax->createView(),
            'get_video_speed_form_ajax' => $get_video_speed_form_ajax->createView(),
            'set_video_speed_form_ajax' => $set_video_speed_form_ajax->createView(),
            'get_lyrics_frame_form_ajax' => $get_lyrics_frame_form_ajax->createView(),
            'increase_amount_views_form_ajax' => $increase_amount_views_form_ajax->createView(),
            'get_keywordUsers_form_ajax' => $get_keywordUsers_form_ajax->createView(),
            'get_videosPerKeywordUsers_form_ajax' => $get_videosPerKeywordUsers_form_ajax->createView(),
            'delete_video_form_ajax' => $delete_video_form_ajax->createView(),
            'get_videos_to_delete_form_ajax' => $get_videos_to_delete_form_ajax->createView(),
            'decline_delete_video_form_ajax' => $decline_delete_video_form_ajax->createView(),
            'get_window_properties_form_ajax' => $get_window_properties_form_ajax->createView(),
            'set_window_theme_color_form_ajax' => $set_window_theme_color_form_ajax->createView()
        ));
    }
    
    private function createCustomForm($objForm, $objEntity, $method, $route) {
        $form = $this->createForm($objForm, $objEntity, array(
            'action' => $this->generateUrl($route),
            'method' => $method
        ));
        return $form;
    }
}