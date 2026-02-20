<?= $this->include('sitecommon/header'); ?>
<div class="wrapper">
    <div class="main-setting">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="event-card rrmt-30">
                        <div class="product_total_stats">
                            <strong class="product_total_numberic">
                                <span class="product_stats_icon"><i class="feather-shopping-cart"></i></span><?php echo $totalFamilies; ?>
                            </strong>
                            <span class="product_stats_label">Families</span>
                        </div>
                    </div>
                    <div class="event-card mt-4">
                        <div class="headtte14m">
                            <span><i class="feather-info"></i></span>
                            <h4>Info</h4>
                        </div>
                        <div class="evntdt99">

                            <div class="mndtlist">
                                <div class="mndesp145 s">
                                    <div class="evarticledes">
                                        <p class="mb-0">St. Alphonsa Syro-Malabar Church, Valiyakolly, is a Roman Catholic church located near Kodenchery in the Kozhikode district of Kerala. Established in 1995, it falls under the jurisdiction of the Diocese of Thamarassery.<br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-12 order-lg-2 order-1">
                    <div class="headtte14m box-shadow_main">
                        <span><i class="feather-users"></i></span>
                        <h4>Messages</h4>
                    </div>
                    <div class="full-width mb-0 rrmt-30">
                        <div class="messages-container">

                            <!-- Recipient Info (show first member or group name) -->
                            <div class="recipients-top-dt">
                                <div class="msg-usr-dt">
                                    <div class="recipient-avatar">
                                        <img src="images/left-imgs/img-2.jpg" loading="lazy" alt="" class="presence-entity__image nt-view-attr__img--centered">
                                        <div class="presence-entity__badge badge__online">
                                            <span class="visually-hidden">Status is online</span>
                                        </div>
                                    </div>
                                    <div class="recipient-user-dt">
                                        <a href="#" target="_blank"><?= esc($group['group_name'] ?? 'Group') ?></a>
                                        <p class="user-last-seen">
                                            <span class="small-last-seen"><?= count($members) ?> members</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="usr-cht-opts-btns">
                                    <span class="option-icon"><i class="feather-phone"></i></span>
                                    <span class="option-icon"><i class="feather-video"></i></span>
                                    <span class="option-icon"><i class="feather-trash-2"></i></span>
                                </div>
                            </div>

                            <!-- Chat Messages -->
                            <div class="chat-container mCustomScrollbar _mCS_3 mCS-autoHide" style="height: 439px; overflow: visible;">
                                <div class="chat-content">
                                    <ul class="chats-lists">
                                        <?php if (!empty($posts)): ?>
                                            <?php foreach ($posts as $post): ?>
                                                <?php
                                                $isMe = ($post['member_id'] == session()->get('user_id')); // adjust according to your login session
                                                ?>
                                                <li class="<?= $isMe ? 'me' : 'you' ?>">
                                                    <div class="chat-thumb">
                                                        <img src="images/left-imgs/img-<?= $isMe ? '1' : '2' ?>.jpg" alt="">
                                                    </div>
                                                    <div class="notifi-event">
                                                        <span class="chat-msg-item">
                                                            <?= esc($post['content']) ?>
                                                        </span>
                                                        <span class="notifi-date">
                                                            <time datetime="<?= esc($post['created_on']) ?>" class="posted-date">
                                                                <?= date('M d, H:i', strtotime($post['created_on'])) ?>
                                                            </time>
                                                        </span>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li>
                                                <div class="notifi-event">
                                                    <span class="chat-msg-item">No messages yet. Start the conversation!</span>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- Send Message Form -->
                            <form class="send_messages_form" method="post" action="<?= base_url('group-send-message') ?>">
                                <input type="hidden" name="group_id" value="<?= $group['group_id'] ?>">
                                <div class="send_input_group">
                                    <div class="msg_write_combo">
                                        <textarea class="form-control custom-controls" name="message" placeholder="Write Something.."></textarea>
                                        <div class="emoji-panel" title="Emoji">
                                            <button type="button" class="emoji-combo ml-2"><i class="fa-regular fa-face-smile"></i></button>
                                        </div>
                                        <div class="mic_recording-icon" title="Audio Recording">
                                            <button type="button" class="mic-record"><i class="feather-mic"></i></button>
                                        </div>
                                    </div>
                                    <span class="input-send-btn">
                                        <button class="btn-main btn-hover send-button" type="submit">
                                            <i class="feather-send"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>


                        </div>
                    </div>

                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="headtte14m box-shadow_main">
                        <span><i class="feather-users"></i></span>
                        <h4>Group Members</h4>
                    </div>
                    <div class="product-items-list pl_item_search">
                        <div class="full-width">
                            <div class="recent-items">
                                <div class="jobs-list">

                                    <?php if (!empty($members)): ?>
                                        <?php foreach ($members as $member): ?>

                                            <div class="media invite125 d-md-flex">

                                                <div class="job-left">
                                                    <!--  -->
                                                </div>

                                                <div class="media-body">
                                                    <a href="#" class="job-heading pt-0 mb_5">
                                                        <?= esc($member['full_name']); ?>
                                                    </a>

                                                    <p class="notification-text font-small-4">
                                                        <span class="cnttme125">
                                                            <?= esc($member['phonenumber']); ?>
                                                        </span>
                                                    </p>
                                                </div>

                                            </div>

                                        <?php endforeach; ?>
                                    <?php else: ?>

                                        <div class="text-center p-4">
                                            <p>No members found in this group.</p>
                                        </div>

                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->include('sitecommon/footer'); ?>