<?php

namespace App\Observers;

use App\Models\TicketReply;

class TicketReplyObserver
{
    /**
     * Handle the TicketReply "created" event.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return void
     */
    public function creating(TicketReply $ticketReply)
    {
        $ticketReply->reply_by=auth()->user()->id;
    }

    /**
     * Handle the TicketReply "updated" event.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return void
     */
    public function updated(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Handle the TicketReply "deleted" event.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return void
     */
    public function deleted(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Handle the TicketReply "restored" event.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return void
     */
    public function restored(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Handle the TicketReply "force deleted" event.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return void
     */
    public function forceDeleted(TicketReply $ticketReply)
    {
        //
    }
}
