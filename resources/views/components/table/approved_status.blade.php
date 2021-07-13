 @if( $record->isApproved())
                            <td nowrap><i class="fa fa-circle text-success"></i> {{ __('common.Approved') }}</td>
                        @elseif(  $record->isRejected())
                            <td nowrap><i class="fa fa-circle text-danger"></i> {{ __('common.Rejected') }}</td>
                        @elseif(  $record->isPending())
                            <td nowrap><i class="fa fa-circle text-secondary"></i> {{ __('common.Pending') }}</td>
                        @endif
