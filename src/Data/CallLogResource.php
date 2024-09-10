<?php

namespace Didntread\NetSapiens\Data;

use Didntread\NetSapiens\Client;

/**
 * Properties for the call log and connection details.
 *
 * @property string $id The unique identifier for the call log entry.
 * @property string $hostname The hostname associated with the call log.
 * @property string $mac The MAC address of the device involved in the call.
 * @property string $cdr_index The Call Detail Record (CDR) index.
 * @property string $orig_callid The original call ID.
 * @property string $orig_ip The IP address of the original caller.
 * @property string $orig_match The original call match criteria.
 * @property string $orig_sub The original call subscriber.
 * @property string $orig_domain The original call domain.
 * @property string $orig_group The original group associated with the call.
 * @property string $orig_from_uri The original URI of the caller.
 * @property string $orig_from_name The name of the original caller.
 * @property string $orig_from_user The username of the original caller.
 * @property string $orig_from_host The host of the original caller.
 * @property string $orig_req_uri The request URI for the original call.
 * @property string $orig_req_user The requested username for the original call.
 * @property string $orig_req_host The requested host for the original call.
 * @property string $orig_to_uri The destination URI of the original call.
 * @property string $orig_to_user The destination username of the original call.
 * @property string $orig_to_host The destination host of the original call.
 * @property string $by_action The action taken on the call.
 * @property string $by_sub The subscriber of the call.
 * @property string $by_domain The domain through which the call was routed.
 * @property string $by_group The group associated with the routing.
 * @property string $by_uri The URI of the routing action.
 * @property string $by_callid The call ID of the routing action.
 * @property string $term_callid The terminating call ID.
 * @property string $term_ip The terminating IP address.
 * @property string $term_match The match criteria for the terminating call.
 * @property string $term_sub The terminating subscriber.
 * @property string $term_domain The terminating domain.
 * @property string $term_to_uri The destination URI of the terminating call.
 * @property string $term_group The terminating group.
 * @property string $time_start The start time of the call.
 * @property string $time_ringing The time when the call started ringing.
 * @property string $time_answer The time when the call was answered.
 * @property string $time_release The time when the call was released.
 * @property string $time_talking The duration of the talking phase in the call.
 * @property string $time_holding The time the call was held.
 * @property string $duration The total duration of the call.
 * @property string $time_insert The time when the record was inserted.
 * @property string $time_disp The time when the call was disposed.
 * @property string $release_code The release code associated with the call.
 * @property string $release_text The release description or reason.
 * @property string $codec The codec used during the call.
 * @property string $rly_prt_0 The relay port 0 data.
 * @property string $rly_prt_a The relay port A data.
 * @property string $rly_prt_b The relay port B data.
 * @property string $rly_cnt_a The relay count A data.
 * @property string $rly_cnt_b The relay count B data.
 * @property string $image_codec The image codec used during the call.
 * @property string $image_prt_0 The image port 0 data.
 * @property string $image_prt_a The image port A data.
 * @property string $image_prt_b The image port B data.
 * @property string $image_cnt_a The image count A data.
 * @property string $image_cnt_b The image count B data.
 * @property string $video_codec The video codec used during the call.
 * @property string $video_prt_0 The video port 0 data.
 * @property string $video_prt_a The video port A data.
 * @property string $video_prt_b The video port B data.
 * @property string $video_cnt_a The video count A data.
 * @property string $video_cnt_b The video count B data.
 * @property string $disp_type The disposition type of the call.
 * @property string $disposition The disposition status of the call.
 * @property string $reason The reason or cause for the disposition.
 * @property string $notes Additional notes related to the call.
 * @property string $pac The PAC (probably related to codec or protocol).
 * @property string $orig_logi_uri The original logical URI of the call.
 * @property string $term_logi_uri The terminating logical URI of the call.
 * @property string $batch_tim_beg The batch start time.
 * @property string $batch_tim_ans The batch answer time.
 * @property string $batch_hold The batch hold time.
 * @property string $batch_dura The batch duration.
 * @property string $orig_id The original identifier for the call.
 * @property string $term_id The terminating identifier for the call.
 * @property string $by_id The identifier for the routing action.
 * @property string $route_to The route to which the call was directed.
 * @property string $route_class The class of the route.
 * @property string $orig_territory The originating territory for the call.
 * @property string $orig_site The originating site for the call.
 * @property string $by_site The site that routed the call.
 * @property string $by_territory The territory that routed the call.
 * @property string $term_territory The terminating territory.
 * @property string $term_site The terminating site.
 * @property string $servedCallId The served call ID (possibly for transferred or forwarded calls).
 */
class CallLogResource extends JsonResource
{
    public function __construct(Client $client, array $data)
    {
        parent::__construct($client);

        $this->meta = [
            'id' => $data['id'],
            'domain' => $data['by_domain'],
        ];

        $this->properties = [
            'id' => $data['id'],
            'hostname' => $data['hostname'],
            'mac' => $data['mac'],
            'cdr_index' => $data['cdr_index'],
            'orig_callid' => $data['orig_callid'],
            'orig_ip' => $data['orig_ip'],
            'orig_match' => $data['orig_match'],
            'orig_sub' => $data['orig_sub'],
            'orig_domain' => $data['orig_domain'],
            'orig_group' => $data['orig_group'],
            'orig_from_uri' => $data['orig_from_uri'],
            'orig_from_name' => $data['orig_from_name'],
            'orig_from_user' => $data['orig_from_user'],
            'orig_from_host' => $data['orig_from_host'],
            'orig_req_uri' => $data['orig_req_uri'],
            'orig_req_user' => $data['orig_req_user'],
            'orig_req_host' => $data['orig_req_host'],
            'orig_to_uri' => $data['orig_to_uri'],
            'orig_to_user' => $data['orig_to_user'],
            'orig_to_host' => $data['orig_to_host'],
            'by_action' => $data['by_action'],
            'by_sub' => $data['by_sub'],
            'by_domain' => $data['by_domain'],
            'by_group' => $data['by_group'],
            'by_uri' => $data['by_uri'],
            'by_callid' => $data['by_callid'],
            'term_callid' => $data['term_callid'],
            'term_ip' => $data['term_ip'],
            'term_match' => $data['term_match'],
            'term_sub' => $data['term_sub'],
            'term_domain' => $data['term_domain'],
            'term_to_uri' => $data['term_to_uri'],
            'term_group' => $data['term_group'],
            'time_start' => $data['time_start'],
            'time_ringing' => $data['time_ringing'],
            'time_answer' => $data['time_answer'],
            'time_release' => $data['time_release'],
            'time_talking' => $data['time_talking'],
            'time_holding' => $data['time_holding'],
            'duration' => $data['duration'],
            'time_insert' => $data['time_insert'],
            'time_disp' => $data['time_disp'],
            'release_code' => $data['release_code'],
            'release_text' => $data['release_text'],
            'codec' => $data['codec'],
            'rly_prt_0' => $data['rly_prt_0'],
            'rly_prt_a' => $data['rly_prt_a'],
            'rly_prt_b' => $data['rly_prt_b'],
            'rly_cnt_a' => $data['rly_cnt_a'],
            'rly_cnt_b' => $data['rly_cnt_b'],
            'image_codec' => $data['image_codec'],
            'image_prt_0' => $data['image_prt_0'],
            'image_prt_a' => $data['image_prt_a'],
            'image_prt_b' => $data['image_prt_b'],
            'image_cnt_a' => $data['image_cnt_a'],
            'image_cnt_b' => $data['image_cnt_b'],
            'video_codec' => $data['video_codec'],
            'video_prt_0' => $data['video_prt_0'],
            'video_prt_a' => $data['video_prt_a'],
            'video_prt_b' => $data['video_prt_b'],
            'video_cnt_a' => $data['video_cnt_a'],
            'video_cnt_b' => $data['video_cnt_b'],
            'disp_type' => $data['disp_type'],
            'disposition' => $data['disposition'],
            'reason' => $data['reason'],
            'notes' => $data['notes'],
            'pac' => $data['pac'],
            'orig_logi_uri' => $data['orig_logi_uri'],
            'term_logi_uri' => $data['term_logi_uri'],
            'batch_tim_beg' => $data['batch_tim_beg'],
            'batch_tim_ans' => $data['batch_tim_ans'],
            'batch_hold' => $data['batch_hold'],
            'batch_dura' => $data['batch_dura'],
            'orig_id' => $data['orig_id'],
            'term_id' => $data['term_id'],
            'by_id' => $data['by_id'],
            'route_to' => $data['route_to'],
            'route_class' => $data['route_class'],
            'orig_territory' => $data['orig_territory'],
            'orig_site' => $data['orig_site'],
            'by_site' => $data['by_site'],
            'by_territory' => $data['by_territory'],
            'term_territory' => $data['term_territory'],
            'term_site' => $data['term_site'],
            'servedCallId' => $data['servedCallId'],
        ];
    }
}
